<?php


class WebsiteController extends Zend_Controller_Action
{
	public function addAction()
	{
		$form = new Application_Form_AddWebsite();
		if ($this->getRequest()->isPost()){
			if ($form->isValid($this->getRequest()->getPost())) {
				$model = new Application_Model_Website();
				$model->fill($form->getValues());
				$model->uri = $model->genUrl($form->getValue('url'));
				$model->save();
				//echo 'Ok';
				$this->_redirect($this->view->url(array('id'=>$model->id,'url'=>$model->uri),'viewwebsite'));
			}else {
				$mssage = $form->getMessages();
				var_dump($mssage);
			}
		}
		$this->view->form = $form;
	}
	public function viewAction(){
		$id = $this->getRequest()->getParam('id');
		$uri = $this->getRequest()->getParam('url');
		$model = new Application_Model_Website();
		$result = $model->view($id, $uri);
		if ($result){
			
			$this->view->headTitle()->prepend($result['name']);
			$this->view->headMeta()->appendName('keywords', $result['keyword']);
			$this->view->headMeta()->appendName('description', $result['description']);
			$this->view->result = $result;
		}
	}
}