<?php
class XPortlet extends CWidget
{
	public $cssFile;
	public $visible=true;
	public $headerimage;
	public $width='100%';
	public $cssClass='portlet';
	public $headerCssClass='header';
	public $contentCssClass='content';
	public $hideOnEmpty=true;
	private $_openTag;
	public function init()
	{
		if($this->visible)
		{
			ob_start();
			ob_implicit_flush(false);

			$cs=Yii::app()->clientScript;
			if($this->cssFile===null)
			{
				$cssFile=CHtml::asset(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'portlet.css');
				$cs->registerCssFile($cssFile);
			}
			else if($this->cssFile!==false)
				$cs->registerCssFile($this->cssFile);

			echo "<div class=\"{$this->cssClass}\" style=\"width:{$this->width}\">\n";
			if($this->headerimage!==null)
				echo "<div class=\"{$this->headerCssClass}\"><img src=\"";
				echo XHtml::imageUrl($this->headerimage);
				echo "\"></div>\n";
			echo "<div class=\"{$this->contentCssClass}\">\n";

			$this->_openTag=ob_get_contents();
			ob_clean();
		}
	}
	public function run()
	{
		if($this->visible)
		{
			$this->renderContent();

			$content=ob_get_clean();
			if($this->hideOnEmpty&&trim($content)==='')
				return;
			echo $this->_openTag;

			echo $content;
			echo "</div><!-- {$this->contentCssClass} -->\n";
			echo "</div><!-- {$this->cssClass} -->";
		}
	}
	protected function renderContent()
	{
	}
}