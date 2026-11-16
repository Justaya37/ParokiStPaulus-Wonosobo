<?php
$orig_path = 'public/images/logo-paroki.jpg';
if (!file_exists($orig_path)) {
    die("Original logo not found\n");
}

$im = imagecreatefromjpeg($orig_path);
$w = imagesx($im);
$h = imagesy($im);

$port_cx = 531.0;
$port_cy = 517.5;
$gold_cx = 522.0;
$gold_cy = 516.5;

// Gold color constants
$gold_r = 204; $gold_g = 167; $gold_b = 86;

// 1. Detect all ink pixels (letters & crosses) in the ring
$raw_ink = array_fill(0, $h, array_fill(0, $w, 0.0));

for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        $dx_p = $x - $port_cx; $dy_p = $y - $port_cy;
        $r_p = sqrt($dx_p * $dx_p + $dy_p * $dy_p);
        
        $dx_g = $x - $gold_cx; $dy_g = $y - $gold_cy;
        $r_g = sqrt($dx_g * $dx_g + $dy_g * $dy_g);
        
        // In the inscription ring
        if ($r_p >= 322 && $r_g <= 471) {
            $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
            // In the original, ink has R,G,B <= 45 and lum >= 5
            $lum = 0.299 * $c['red'] + 0.587 * $c['green'] + 0.114 * $c['blue'];
            $max_c = max($c['red'], $c['green'], $c['blue']);
            
            // Exclude any accidental gold tint
            if ($max_c <= 50 && ($lum >= 5 || $max_c >= 6)) {
                // Normalized ink strength (0.0 to 1.0)
                $strength = min(1.0, ($lum - 3.0) / 16.0);
                $raw_ink[$y][$x] = $strength;
            }
        }
    }
}

// 2. Morphological dilation for crisp visibility & anti-aliasing
$ink = array_fill(0, $h, array_fill(0, $w, 0.0));
$dilation_radius = 2.0;

for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        $dx_p = $x - $port_cx; $dy_p = $y - $port_cy;
        $r_p = sqrt($dx_p * $dx_p + $dy_p * $dy_p);
        $dx_g = $x - $gold_cx; $dy_g = $y - $gold_cy;
        $r_g = sqrt($dx_g * $dx_g + $dy_g * $dy_g);
        
        if ($r_p < 321 || $r_g > 473) continue;
        
        $max_val = 0.0;
        for ($dy = -2; $dy <= 2; $dy++) {
            $ny = $y + $dy;
            if ($ny < 0 || $ny >= $h) continue;
            for ($dx = -2; $dx <= 2; $dx++) {
                $nx = $x + $dx;
                if ($nx < 0 || $nx >= $w) continue;
                $dist = sqrt($dx * $dx + $dy * $dy);
                if ($dist <= $dilation_radius) {
                    $val = $raw_ink[$ny][$nx] * (1.0 - $dist * 0.15);
                    if ($val > $max_val) $max_val = $val;
                }
            }
        }
        $ink[$y][$x] = $max_val;
    }
}

// 3. Construct new truecolor PNG image
$out = imagecreatetruecolor($w, $h);
imagealphablending($out, false);
imagesavealpha($out, true);

$transparent = imagecolorallocatealpha($out, 255, 255, 255, 127);
$white = imagecolorallocate($out, 255, 255, 255);
imagefilledrectangle($out, 0, 0, $w, $h, $transparent);

for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        $dx_p = $x - $port_cx; $dy_p = $y - $port_cy;
        $r_p = sqrt($dx_p * $dx_p + $dy_p * $dy_p);
        
        $dx_g = $x - $gold_cx; $dy_g = $y - $gold_cy;
        $r_g = sqrt($dx_g * $dx_g + $dy_g * $dy_g);
        
        // Zone A: Center portrait of Saint Paul
        if ($r_p <= 317.0) {
            imagesetpixel($out, $x, $y, imagecolorat($im, $x, $y));
        }
        // Zone B: Fine gold bezel separating portrait from inscription ring
        elseif ($r_p > 317.0 && $r_p <= 321.5) {
            $t = ($r_p - 317.0) / 4.5;
            $orig_color = imagecolorsforindex($im, imagecolorat($im, $x, $y));
            // Blend gold tone with subtle shading
            $br = (int)round((1.0 - $t * 0.3) * $gold_r);
            $bg = (int)round((1.0 - $t * 0.3) * $gold_g);
            $bb = (int)round((1.0 - $t * 0.3) * $gold_b);
            imagesetpixel($out, $x, $y, imagecolorallocate($out, $br, $bg, $bb));
        }
        // Zone C: White inscription ring with black text & crosses
        elseif ($r_p > 321.5 && $r_g < 474.0) {
            $ink_strength = $ink[$y][$x] ?? 0.0;
            if ($ink_strength > 0.06) {
                // Boost darkness for sharp contrast
                $darkness = min(1.0, pow($ink_strength, 0.6) * 1.3);
                $val = (int)round(255.0 * (1.0 - $darkness));
                $val = max(10, min(255, $val)); // dark charcoal / black
                imagesetpixel($out, $x, $y, imagecolorallocate($out, $val, $val, $val));
            } else {
                // Pure clean white background in the ring
                imagesetpixel($out, $x, $y, $white);
            }
        }
        // Zone D: Outer gold ring (with original texture and gradient)
        elseif ($r_g >= 474.0 && $r_g <= 509.0) {
            imagesetpixel($out, $x, $y, imagecolorat($im, $x, $y));
        }
        // Zone E: Smooth anti-aliased edge of outer gold ring
        elseif ($r_g > 509.0 && $r_g <= 512.0) {
            $t = ($r_g - 509.0) / 3.0; // 0 to 1
            $orig = imagecolorsforindex($im, imagecolorat($im, $x, $y));
            // Anti-alias into pure white
            $blend_r = (int)round($orig['red'] * (1.0 - $t) + 255 * $t);
            $blend_g = (int)round($orig['green'] * (1.0 - $t) + 255 * $t);
            $blend_b = (int)round($orig['blue'] * (1.0 - $t) + 255 * $t);
            imagesetpixel($out, $x, $y, imagecolorallocate($out, $blend_r, $blend_g, $blend_b));
        }
        // Zone F: Outside the gold ring (corners) -> pure clean white
        else {
            imagesetpixel($out, $x, $y, $white);
        }
    }
}

// Save as both PNG (lossless truecolor) and JPG
imagepng($out, 'public/images/logo-paroki.png');
imagejpeg($out, 'public/images/logo-paroki.jpg', 96);
echo "Successfully generated public/images/logo-paroki.png and public/images/logo-paroki.jpg\n";
