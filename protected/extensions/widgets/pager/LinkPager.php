<?php

/**
 * LinkPager class file.
 */
class LinkPager extends CLinkPager
{
    /**
     * @see CLinkPager::init()
     */
    public function init()
    {
		$this->firstPageLabel ='&lt;&lt;';
		$this->prevPageLabel ='&lt;';
		$this->nextPageLabel ='&gt;';
		$this->lastPageLabel ='&gt;&gt;';
        $this->firstPageCssClass='pager_first';//default "first"
        $this->lastPageCssClass='pager_last';//default "last"
	    $this->htmlOptions['id'] = $this->getId();
        $this->htmlOptions['class'] = 'pager';
    }

    /**
     * @see CLinkPager::run()
     */
    public function run()
    {
        $buttons = $this->createPageButtons();

        if (empty($buttons)) {
            return;
        }
        echo CHtml::tag('ul', $this->htmlOptions, implode("\n", $buttons));
		//echo "test".$this->getId();
    }
}

