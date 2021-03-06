<?php
/**
 * 资源（图片）控制器
 */
class attachment_controller extends base_controller{
	// 上传
	public function upload() {
		if(!empty($_FILES['file']) && $_FILES['file']['error'] != 4) {
			$img_path_str = '';
		
			// 用会员uid
			$img_path_str = sprintf("%09d", $this->user['uid']);
		
			// 产生目录结构
			$rand_num = 'images/' . substr($img_path_str, 0, 3) . '/' . substr($img_path_str, 3, 3) . '/' . substr($img_path_str, 6, 3) . '/' . date('Ym', $_SERVER['REQUEST_TIME']) . '/';
		
			$upload_dir = PIGCMS_PATH . '/upload/' . $rand_num;
			if(!is_dir($upload_dir)) {
				mkdir($upload_dir, 0777, true);
			}
		
			// 进行上传图片处理
			import('UploadFile');
			$upload = new UploadFile();
			$upload->maxSize = 1 * 1024 * 1024;
			$upload->allowExts = array('jpg', 'jpeg', 'png', 'gif');
			$upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
			$upload->savePath = $upload_dir;
			$upload->saveRule = 'uniqid';
			if($upload->upload()) {
				$uploadList = $upload->getUploadFileInfo();
				//$pigcms_id = $this->_attachmentAdd($uploadList[0]['name'], $rand_num . $uploadList[0]['savename'], $uploadList[0]['size']);
				$data['uid'] = $this->user['uid'];
				$data['name'] = $uploadList[0]['name'];
				$data['from'] = 0;
				$data['type'] = 0;
				$data['file'] = $rand_num . $uploadList[0]['savename'];
				$data['size'] = $uploadList[0]['size'];
				$data['add_time'] = $_SERVER['REQUEST_TIME'];
				$data['ip'] = get_client_ip(1);
				$data['agent'] = $_SERVER['HTTP_USER_AGENT'];
				
				if($type == 0) {
					list($data['width'], $data['height']) = getimagesize(PIGCMS_PATH . '/upload/' . $rand_num . $uploadList[0]['savename']);
				}
				
				$pigcms_id = M('Attachment_user')->add($data);
				
				if (!$pigcms_id) {
					unlink($upload_dir . $uploadList[0]['name']);
					
					json_return(1000, '图片上传失败');
					exit;
				} else {
					$attachment_upload_type = option('config.attachment_upload_type');
					// 上传到又拍云服务器
					if ($attachment_upload_type == '1') {
						import('source.class.upload.upyunUser');
						upyunUser::upload(PIGCMS_PATH . '/upload/' . $rand_num . $uploadList[0]['savename'], '/' . $rand_num . $uploadList[0]['savename']);
					}
					
					json_return(0, getAttachmentUrl($rand_num . $uploadList[0]['savename']));
					exit;
				}
			} else {
				json_return(1000, '图片上传失败');
				exit;
			}
		} else {
			json_return(1000, '图片上传失败');
		}
	}
}
