<?php

/**
 * This is the model class for table "{{document}}".
 *
 * The followings are the available columns in table '{{document}}':
 * @property string $did
 * @property string $lng
 * @property integer $pid
 * @property integer $mid
 * @property integer $aid
 * @property string $tid
 * @property string $extid
 * @property string $sid
 * @property string $fgid
 * @property string $linkdid
 * @property integer $isclass
 * @property integer $islink
 * @property integer $ishtml
 * @property integer $ismess
 * @property integer $isorder
 * @property string $ktid
 * @property integer $purview
 * @property integer $istemplates
 * @property integer $isbase
 * @property string $recommend
 * @property string $tsn
 * @property string $title
 * @property string $longtitle
 * @property string $color
 * @property string $author
 * @property string $source
 * @property string $pic
 * @property string $tags
 * @property string $keywords
 * @property string $description
 * @property string $summary
 * @property string $link
 * @property string $oprice
 * @property string $bprice
 * @property integer $click
 * @property string $addtime
 * @property string $uptime
 * @property string $template
 * @property string $filename
 * @property string $filepath
 * @property integer $filepage
 */
class Document extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{document}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('extid, linkdid, recommend, title, longtitle, color, author, source, pic, tags, description, summary, link, template, filepath', 'required'),
			array('pid, mid, aid, isclass, islink, ishtml, ismess, isorder, purview, istemplates, isbase, click, filepage', 'numerical', 'integerOnly'=>true),
			array('lng, tsn', 'length', 'max'=>50),
			array('tid, sid, addtime, uptime', 'length', 'max'=>11),
			array('extid, title, longtitle, pic, filepath', 'length', 'max'=>200),
			array('fgid, color', 'length', 'max'=>8),
			array('linkdid, recommend, template, filename', 'length', 'max'=>100),
			array('ktid', 'length', 'max'=>6),
			array('author', 'length', 'max'=>20),
			array('source', 'length', 'max'=>30),
			array('tags, link', 'length', 'max'=>250),
			array('keywords', 'length', 'max'=>220),
			array('oprice, bprice', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('did, lng, pid, mid, aid, tid, extid, sid, fgid, linkdid, isclass, islink, ishtml, ismess, isorder, ktid, purview, istemplates, isbase, recommend, tsn, title, longtitle, color, author, source, pic, tags, keywords, description, summary, link, oprice, bprice, click, addtime, uptime, template, filename, filepath, filepage', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'hm_dc_did' => array(self::HAS_MANY, 'DocumentContent', 'did'),
				'bt_t_linkid' => array(self::BELONGS_TO, 'typelist', 'tid'),
				'bt_t_tid' => array(self::BELONGS_TO, 'typelist', 'tid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'did' => 'Did',
			'lng' => 'Lng',
			'pid' => 'Pid',
			'mid' => 'Mid',
			'aid' => 'Aid',
			'tid' => 'Tid',
			'extid' => 'Extid',
			'sid' => 'Sid',
			'fgid' => 'Fgid',
			'linkdid' => 'Linkdid',
			'isclass' => 'Isclass',
			'islink' => 'Islink',
			'ishtml' => 'Ishtml',
			'ismess' => 'Ismess',
			'isorder' => 'Isorder',
			'ktid' => 'Ktid',
			'purview' => 'Purview',
			'istemplates' => 'Istemplates',
			'isbase' => 'Isbase',
			'recommend' => 'Recommend',
			'tsn' => 'Tsn',
			'title' => 'Title',
			'longtitle' => 'Longtitle',
			'color' => 'Color',
			'author' => 'Author',
			'source' => 'Source',
			'pic' => 'Pic',
			'tags' => 'Tags',
			'keywords' => 'Keywords',
			'description' => 'Description',
			'summary' => 'Summary',
			'link' => 'Link',
			'oprice' => 'Oprice',
			'bprice' => 'Bprice',
			'click' => 'Click',
			'addtime' => 'Addtime',
			'uptime' => 'Uptime',
			'template' => 'Template',
			'filename' => 'Filename',
			'filepath' => 'Filepath',
			'filepage' => 'Filepage',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('did',$this->did,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('aid',$this->aid);
		$criteria->compare('tid',$this->tid,true);
		$criteria->compare('extid',$this->extid,true);
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('fgid',$this->fgid,true);
		$criteria->compare('linkdid',$this->linkdid,true);
		$criteria->compare('isclass',$this->isclass);
		$criteria->compare('islink',$this->islink);
		$criteria->compare('ishtml',$this->ishtml);
		$criteria->compare('ismess',$this->ismess);
		$criteria->compare('isorder',$this->isorder);
		$criteria->compare('ktid',$this->ktid,true);
		$criteria->compare('purview',$this->purview);
		$criteria->compare('istemplates',$this->istemplates);
		$criteria->compare('isbase',$this->isbase);
		$criteria->compare('recommend',$this->recommend,true);
		$criteria->compare('tsn',$this->tsn,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('longtitle',$this->longtitle,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('oprice',$this->oprice,true);
		$criteria->compare('bprice',$this->bprice,true);
		$criteria->compare('click',$this->click);
		$criteria->compare('addtime',$this->addtime,true);
		$criteria->compare('uptime',$this->uptime,true);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('filepath',$this->filepath,true);
		$criteria->compare('filepage',$this->filepage);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
		public function getUrl()
	{
		return Yii::app()->createUrl('site/view', array(
				'did'=>$this->did,
				'title'=>$this->title,
				'topid'=>$this->bt_t_linkid->topid,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Document the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
