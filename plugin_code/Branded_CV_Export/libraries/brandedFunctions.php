<?php
class BrandedFunctions
{
    // get aspect ration of image according to image size
    function getAspectRatio($originalheight,$originalwidth,$height,$width)
    {
	$returnHeight = 0;
	$returnWidth = 0;
	if($height>$originalheight && $width>$originalwidth)
	{
		$dh= $height-$originalheight;
		$dw=$width-$originalwidth;
		if($dw>$dh)
		{
			$newwidth=$originalwidth;
			$newheight=round(($originalheight/$originalwidth)*$newwidth);
			if($newwidth<$originalheight && $newwidth<$originalwidth)
			{
				$returnWidth =  $newwidth;
				$returnHeight =  $newheight;
			}
			else
			{
				$returnWidth =  $originalwidth;
				$returnHeight =  $originalheight;
			}
		}
		else
		{
			$newheight=$originalheight;
			$newwidth=round(($originalwidth/$originalheight)*$newheight);
			if($newwidth<$originalheight && $newwidth<$originalwidth)
			{
				$returnWidth =  $newwidth;
				$returnHeight =  $newheight;
			}
			else
			{
				$returnWidth =  $originalwidth;
				$returnHeight = $originalheight;
			}
		}
	}
	elseif($height<$originalheight && $width<$originalwidth)
	{
		$dh= $originalheight-$height;
		$dw=$originalwidth-$width;
		if($dw>$dh)
		{
			$newwidth=$width;
			$newheight=round(($originalheight*$newwidth)/$originalwidth);
			$returnWidth =  $newwidth;
			$returnHeight = $newheight;
		}
		else
		{
			$newheight=$height;
			$newwidth=round(($originalwidth*$newheight)/$originalheight);
			$returnWidth =  $newwidth;
			$returnHeight = $newheight;
		}
	}
	elseif($height<$originalheight)
	{
		$returnHeight = $height;
		$newwidth=round(($originalwidth*$height)/$originalheight);
		$returnWidth =  $newwidth;
	}
	elseif($width<$originalwidth)
	{
		$returnWidth =  $width;
	        $newheight=round(($originalheight*$width)/$originalwidth);
		$returnHeight = $newheight;
	}
	else
	{
		$returnWidth =  $originalwidth;
		$returnHeight = $originalheight;
	}
	return array('w'=>$returnWidth,'h'=>$returnHeight);
    }
}


