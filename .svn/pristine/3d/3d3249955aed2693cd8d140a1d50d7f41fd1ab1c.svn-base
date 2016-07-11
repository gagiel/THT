<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 将图片转存为宽度300的jpg
 */
if (!function_exists('pic_jpg_300')) 
{
	function pic_jpg_300($file,$src)
	{
		$data = @GetImageSize($file);   
		switch ($data['2'])
		{
			case 1:
				$im = imagecreatefromgif($file);
				break;
			case 2:
				$im = imagecreatefromjpeg($file);
				break;
			case 3:
				$tmp = imagecreatefrompng($file);
				$w = imagesx($tmp);
				$y = imagesy($tmp);
				$im = imagecreatetruecolor($w, $y);
				$bg = imagecolorallocate($im, 255, 255, 255);
				imagefill($im, 0, 0, $bg);
				imagecopyresized($im, $tmp, 0, 0, 0, 0,$w, $y, $w, $y);
				break;
			case 6:
				$im = ImageCreateFromBMP($file);
				break;
		}
		
		$srcW=@ImageSX($im);
		$srcH=@ImageSY($im);
		
		$new_w=300;
		$new_h = floor($srcH*$new_w/$srcW); 
		
		$ni=@imageCreateTrueColor($new_w,$new_h);
		@ImageCopyResampled($ni,$im,0,0,0,0,$new_w,$new_h,$srcW,$srcH);
		
		$re = @ImageJpeg($ni,$src,80); 
		@imagedestroy($im);
		@imagedestroy($ni);
		
		return $re;
	}
}

/**
 * 将图片转存为指定宽、高的jpg
 */
if (!function_exists('pic_jpg')) 
{
	function pic_jpg($file,$src,$new_w,$new_h)
	{
		$data = @GetImageSize($file);   
		switch ($data['2'])
		{
			case 1:
				$im = imagecreatefromgif($file);
				break;
			case 2:
				$im = imagecreatefromjpeg($file);
				break;
			case 3:
				$tmp = imagecreatefrompng($file);
				$w = imagesx($tmp);
				$y = imagesy($tmp);
				$im = imagecreatetruecolor($w, $y);
				$bg = imagecolorallocate($im, 255, 255, 255);
				imagefill($im, 0, 0, $bg);
				imagecopyresized($im, $tmp, 0, 0, 0, 0,$w, $y, $w, $y);
				break;
			case 6:
				$im = ImageCreateFromBMP($file);
				break;
		}
		
		$srcW=@ImageSX($im);
		$srcH=@ImageSY($im);
		
		$ni=@imageCreateTrueColor($new_w,$new_h);
		@ImageCopyResampled($ni,$im,0,0,0,0,$new_w,$new_h,$srcW,$srcH);
		
		$re = @ImageJpeg($ni,$src,80); 
		@imagedestroy($im);
		@imagedestroy($ni);
		
		return $re;
	}
}

/**
 * 上传图片功能
 * @param string $field_name 图片名称
 * return string 图片的路径
 */
if(!function_exists('upload_picture'))
{
	function upload_picture($field_name)
	{
		//上传	
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'png|gif|jpg';
		$config['max_size'] = '1500';
		$config['max_width'] = '1024';
		$config['max_height'] = '1024';
		
		$this->load->library('upload', $config);
		$load = $this->upload->do_upload($field_name);

		if (!$load) 
		{
			return array('succ'=>false,'msg'=>'图片上传失败');
		} 
		else
		{
			$data = $this->upload->data();
			$logo = $data['full_path'];
			$picArr = explode('/uploads/', $logo);
			$logo = '/uploads/' . $picArr[1];
			
			$pic = isset($logo) ? $logo : '';
			return array('succ'=>true,'pic'=>$pic);
		}
	}
}