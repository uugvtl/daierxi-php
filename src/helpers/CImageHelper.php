<?php
class CImageHelper extends CBaseHelper
{
    /**
     * 返回文件的扩展名
     * @param string $imgPath       图片的路径
     * @return string               成功返回图片的扩展名，否则返回空字符串
     */
    public function getExtension($imgPath)
    {
        $extension = '';
        if(file_exists($imgPath)){
            $info = getimagesize($imgPath);
            $extension = image_type_to_extension($info['2'], false);
        }

        return $extension;
    }

    /**
     * 把图片转成base64字符串
     * @param string $filePath          图片文件路径
     * @return string                   经过base64压缩后的字符串
     */
    public function picToBase64($filePath)
    {
        $strBase64 = '';
        if(is_file($filePath))
        {
            $fileHelper = CFileHelper::getInstance();
            $mimeType = $fileHelper->getMimeTypeByExtension($filePath);
            $strBase64 = "data:{$mimeType};base64,";
            $fp = fopen($filePath, 'rb');
            $strBase64.= chunk_split(base64_encode(fread($fp,filesize($filePath))));
        }

        return $strBase64;
    }

    /**
     * 混合两张图片
     * @param string $coverpageImagePath		封面图片
     * @param string $destImagePath				上层图片
     * @param boolean $isCoverImageForce        以前景图为主
     */
    public function mixinsImage($coverpageImagePath, $destImagePath, $isCoverImageForce=true)
    {
        $destImage = $I = null;

        if(is_file($coverpageImagePath))
        {
            if(is_file($destImagePath))
            {
                $destImageW = $destImageH = 0;

                $imageFileExtension = substr($destImagePath, -3);
                switch ($imageFileExtension) {
                    case "jpg" :
                        $destImage = imagecreatefromjpeg($destImagePath);
                        $destImageW = imagesx($destImage);
                        $destImageH = imagesy($destImage);
                        break;
                    case "gif" :
                        $destImage = imagecreatefromgif($destImagePath);
                        $destImageW = imagesx($destImage);
                        $destImageH = imagesy($destImage);
                        break;
                    case "bmp" :
                        $destImage = imagecreatefromwbmp($destImagePath);
                        $destImageW = imagesx($destImage);
                        $destImageH = imagesy($destImage);
                        break;
                    case "png" :
                        $destImage = imagecreatefrompng($destImagePath);
                        $destImageW = imagesx($destImage);
                        $destImageH = imagesy($destImage);
                        break;
                }



                $coverpageImage			= imagecreatefrompng($coverpageImagePath);
                $coverpageImageWidth	= imagesx($coverpageImage);
                $coverpageImageHeight	= imagesy($coverpageImage);

                if($isCoverImageForce)
                {
                    $blank = imagecreatetruecolor($coverpageImageWidth, $coverpageImageHeight);
                    imagecopy($blank, $destImage, 0,0,0,0,$destImageW,$destImageH);
                    $toggle = imagecopy($blank, $coverpageImage, 0,0,0,0,$coverpageImageWidth,$coverpageImageHeight);
                }
                else
                {
                    $blank = $destImage;
                    $toggle = imagecopyresampled($destImage, $coverpageImage, 0,0,0,0, $destImageW,$destImageH, $coverpageImageWidth,$coverpageImageHeight);
                }

                if($toggle)
                {
                    switch (strtolower($imageFileExtension)) {
                        case "jpg" :
                            $I = imagejpeg($blank, $destImagePath);
                            break;
                        case "gif" :
                            $I = imagegif($blank, $destImagePath);
                            break;
                        case "bmp" :
                            $I = imagewbmp($blank, $destImagePath);
                            break;
                        case "png" :
                            $I = imagepng($blank, $destImagePath);
                            break;
                    }
                    
                    if($I)
                    {
                        imagedestroy($coverpageImage);
                        imagedestroy($destImage);
                        if($isCoverImageForce) imagedestroy($blank);
                    }
                }
                
            }
        }
    }


    /**
     * 生成缩略图
     * @author yangzhiguo0903@163.com
     * @param string     $src_img 源图绝对完整地址{带文件名及后缀名}
     * @param string     $dst_img 目标图绝对完整地址{带文件名及后缀名}
     * @param int        $width 缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
     * @param int        $height 缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
     * @param int        $cut 是否裁切{宽,高必须非0}
     * @param int/float  缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
     * @return boolean
     */
    public function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
    {
        if(!is_file($src_img))
        {
            return false;
        }
        $ot = $this->getExtension($src_img);
        $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
        $srcinfo = getimagesize($src_img);
        $src_w = $srcinfo[0];
        $src_h = $srcinfo[1];
        $type  = strtolower(image_type_to_extension($srcinfo[2], false));
        $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

        $dst_h = $height;
        $dst_w = $width;
        $x = $y = 0;

        /**
         * 缩略图不超过源图尺寸（前提是宽或高只有一个）
         */
        if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
        {
            $proportion = 1;
        }
        if($width> $src_w)
        {
            $dst_w = $width = $src_w;
        }
        if($height> $src_h)
        {
            $dst_h = $height = $src_h;
        }

        if(!$width && !$height && !$proportion)
        {
            return false;
        }
        if(!$proportion)
        {
            if($cut == 0)
            {
                if($dst_w && $dst_h)
                {
                    if($dst_w/$src_w> $dst_h/$src_h)
                    {
                        $dst_w = $src_w * ($dst_h / $src_h);
                        $x = 0 - ($dst_w - $width) / 2;
                    }
                    else
                    {
                        $dst_h = $src_h * ($dst_w / $src_w);
                        $y = 0 - ($dst_h - $height) / 2;
                    }
                }
                else if($dst_w xor $dst_h)
                {
                    if($dst_w && !$dst_h)  //有宽无高
                    {
                        $propor = $dst_w / $src_w;
                        $height = $dst_h  = $src_h * $propor;
                    }
                    else if(!$dst_w && $dst_h)  //有高无宽
                    {
                        $propor = $dst_h / $src_h;
                        $width  = $dst_w = $src_w * $propor;
                    }
                }
            }
            else
            {
                if(!$dst_h)  //裁剪时无高
                {
                    $height = $dst_h = $dst_w;
                }
                if(!$dst_w)  //裁剪时无宽
                {
                    $width = $dst_w = $dst_h;
                }
                $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
                $dst_w = (int)round($src_w * $propor);
                $dst_h = (int)round($src_h * $propor);
                $x = ($width - $dst_w) / 2;
                $y = ($height - $dst_h) / 2;
            }
        }
        else
        {
            $proportion = min($proportion, 1);
            $height = $dst_h = $src_h * $proportion;
            $width  = $dst_w = $src_w * $proportion;
        }

        $src = $createfun($src_img);
        $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);

        if(function_exists('imagecopyresampled'))
        {
            imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        else
        {
            imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        $otfunc($dst, $dst_img);
        imagedestroy($dst);
        imagedestroy($src);
        return true;
    }
}
