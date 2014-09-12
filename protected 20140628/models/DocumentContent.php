<?php

/**
 * This is the model class for table "{{document_content}}".
 *
 * The followings are the available columns in table '{{document_content}}':
 * @property integer $dcid
 * @property integer $did
 * @property string $content
 */
class DocumentContent extends CActiveRecord
{
	
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{document_content}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('did, content', 'required'),
			array('did', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dcid, did, content', 'safe', 'on'=>'search'),
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
		'gettitlefromdocument' => array(self::BELONGS_TO, 'document', 'dcid'),
		
/* 		'addtime' => array(self::BELONGS_TO, 'Typelist', 'content'),
		'url' => array(self::BELONGS_TO, 'Typelist', 'content'),,'condition'=>'tid=1 or tid=2 or tid=3 or tid=4 or tid=5 or tid=6 or tid=7'
		'picfile' => array(self::BELONGS_TO, 'Typelist', 'content'), */
		);
	}
	
	
	public function getUrl()
	{
	
		return Yii::app()->createUrl('mysite/viewabout', array(
				'tid'=>$this->did,
				'typename'=>$this->gettitlefromtypelist->typename,
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dcid' => 'Dcid',
			'did' => 'Did',
			'content' => 'Content',
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

		$criteria->compare('dcid',$this->dcid);
		$criteria->compare('did',$this->did);
		$criteria->compare('content',$this->content,true);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			
		));
	}
	


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocumentContent the static model class
	 */

}
