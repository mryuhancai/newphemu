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
				'getcontent' => array(self::HAS_MANY, 'DocumentContent', 'did'),
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
	
	
	public function latestNews($tid=52,$limit=6)
	{
		$newsTitle=$this->findAll(array(
		
		
			'condition'=>'tid='.$tid,
			'order'=>'did DESC',
			'limit'=>$limit,
		));
		$names=array();
		foreach($newsTitle as $title)
		
		if (strlen($title->title)>38){$title->title=self::cut_str($title->title,21);;$names[]=$title->title; }
		else{
		$names[]=$title->title;}
		
		return $names;
	}
	 
	 
	 public function newProduct($mid=3,$tid=9,$limit=20)
	{
		$pics=$this->findAll(array(
			
			'condition'=>'mid='.$mid,
			//'order'=>'uptime DESC',
			'limit'=>$limit,
		));
		$names=array();
		foreach($pics as $pic)
		
		{
		$names[]=$pic->pic;
		}
		
		return $names;
	}
	 
	 
	  public function newCooperation($tid=63,$limit=20)
	{
		$pics=$this->findAll(array(
			
			'condition'=>'tid='.$tid,
			//'order'=>'uptime DESC',
			'limit'=>$limit,
		));
		$names=array();
		foreach($pics as $pic)
		
		{
		$names[]=$pic->pic;
		}
		
		return $names;
	}
	 

	/***璇ュ嚱鏁颁笉鑳界敤浜巙tf8缂栫爜瀛楃涓诧紝浼氬嚭鐜颁贡鐮� ***/
	private function splitStr($str,$len)
    {
    if($len<=0)
    {
    return false;
    }
    else
    {
    $sLen=strlen($str);
    if($len>=$sLen)
    return $str;
    else
    {
    for($i=0;$i<($len-1);$i++)
    {
    if(ord(substr($str,$i,1))>0xa0)
    $i++;
    }

    if($i>=$len)
    return substr($str,0,$len);
    elseif(ord(substr($str,$i,1))>0xa0)
    return substr($str,0,$len-1);
    else
    return substr($str,0,$len);
    }
    }
    }
	
	/************/
	

	
	
	/***PHP鎴彇涓枃瀛楃涓叉柟娉�**/
	private function msubstr($str, $start, $len) {
    $tmpstr = "";
    $strlen = $start + $len;
     for($i = 0; $i < $strlen; $i++) {
         if(ord(substr($str, $i, 1)) > 0xa0) {
            $tmpstr .= substr($str, $i, 2);
            $i++;
         } else
            $tmpstr .= substr($str, $i, 1);
     }
     return $tmpstr;
} 
	
	/**杩欎釜鎴彇姹夊瓧鐨勫嚱鏁颁笉閿�*/
private function cut_str($sourcestr,$cutlength)
{
   $returnstr='';
   $i=0;
   $n=0;
   $str_length=strlen($sourcestr);//瀛楃涓茬殑瀛楄妭鏁�   while (($n<$cutlength) and ($i<=$str_length))
    {
      $temp_str=substr($sourcestr,$i,1);
      $ascnum=Ord($temp_str);//寰楀埌瀛楃涓蹭腑绗�i浣嶅瓧绗︾殑ascii鐮�      if ($ascnum>=224)    //濡傛灉ASCII浣嶉珮涓�24锛�      {
         $returnstr=$returnstr.substr($sourcestr,$i,3); //鏍规嵁UTF-8缂栫爜瑙勮寖锛屽皢3涓繛缁殑瀛楃璁′负鍗曚釜瀛楃         
         $i=$i+3;            //瀹為檯Byte璁′负3
         $n++;            //瀛椾覆闀垮害璁�
      }
       elseif ($ascnum>=192) //濡傛灉ASCII浣嶉珮涓�92锛�      {
         $returnstr=$returnstr.substr($sourcestr,$i,2); //鏍规嵁UTF-8缂栫爜瑙勮寖锛屽皢2涓繛缁殑瀛楃璁′负鍗曚釜瀛楃
         $i=$i+2;            //瀹為檯Byte璁′负2
         $n++;            //瀛椾覆闀垮害璁�
      }
       elseif ($ascnum>=65 && $ascnum<=90) //濡傛灉鏄ぇ鍐欏瓧姣嶏紝
      {
         $returnstr=$returnstr.substr($sourcestr,$i,1);
         $i=$i+1;            //瀹為檯鐨凚yte鏁颁粛璁�涓�         $n++;            //浣嗚�铏戞暣浣撶編瑙傦紝澶у啓瀛楁瘝璁℃垚涓�釜楂樹綅瀛楃
      }
       else                //鍏朵粬鎯呭喌涓嬶紝鍖呮嫭灏忓啓瀛楁瘝鍜屽崐瑙掓爣鐐圭鍙凤紝
      {
         $returnstr=$returnstr.substr($sourcestr,$i,1);
         $i=$i+1;            //瀹為檯鐨凚yte鏁拌1涓�         $n=$n+0.5;        //灏忓啓瀛楁瘝鍜屽崐瑙掓爣鐐圭瓑涓庡崐涓珮浣嶅瓧绗﹀...
      }
    }
          if ($str_length>$cutlength){
          $returnstr = $returnstr . "...";//瓒呰繃闀垮害鏃跺湪灏惧鍔犱笂鐪佺暐鍙�      }
     return $returnstr;

} 
	
	
    private function cutstr($string, $length, $dot = ' ...') {
    global $charset;

    if(strlen($string) <= $length) {
        return $string;
    }

    $string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);

    $strcut = '';
    if(strtolower($charset) == 'utf-8') {

        $n = $tn = $noc = 0;
        while($n < strlen($string)) {

            $t = ord($string[$n]);
            if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $tn = 1; $n++; $noc++;
            } elseif(194 <= $t && $t <= 223) {
                $tn = 2; $n += 2; $noc += 2;
            } elseif(224 <= $t && $t <= 239) {
                $tn = 3; $n += 3; $noc += 2;
            } elseif(240 <= $t && $t <= 247) {
                $tn = 4; $n += 4; $noc += 2;
            } elseif(248 <= $t && $t <= 251) {
                $tn = 5; $n += 5; $noc += 2;
            } elseif($t == 252 || $t == 253) {
                $tn = 6; $n += 6; $noc += 2;
            } else {
                $n++;
            }

            if($noc >= $length) {
                break;
            }

        }
        if($noc > $length) {
            $n -= $tn;
        }

        $strcut = substr($string, 0, $n);

    } else {
        for($i = 0; $i < $length; $i++) {
            $strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
        }
    }

    $strcut = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);

    return $strcut.$dot;
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
