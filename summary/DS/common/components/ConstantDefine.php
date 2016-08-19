<?php

/**
 * Class defined all the Constant value of the CMS.
 * 
 * 
 * @author Tuan Nguyen
 * @version 1.0
 * @package common.components
 */

class ConstantDefine{
    	
	
	const AMAZON_SES_ACCESS_KEY='AKIAJGDENSYQ6TFPJABA';
	const AMAZON_SES_SECRET_KEY='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';
	
	const AMAZON_SES_EMAIL='';	
	const SUPPORT_EMAIL='';
	
	
	/**
     * Constant related to Upload File Size
     */   
	const UPLOAD_MAX_SIZE=10485760; //10mb
    const UPLOAD_MIN_SIZE=1; //1 byte
    
    public static function fileTypes(){
        return array(
            'image'=>array('jpg','gif','png','bmp','jpeg'),
            'audio'=>array('mp3','wma','wav'),
            'video'=>array('flv','wmv','avi','mp4','mov','3gp'),
            'flash'=>array('swf'),
            'file'=>array('*'),           
            );
    }
	
	public static function chooseFileTypes(){
		return array(
			'auto'=>t('Auto detect'),
			'image'=>t('Image'),
			'video'=>t('Video'),
			'audio'=>t('Audio'),
			'file'=>t('File'),
		);
	}
	
	
    
    /**
     * Constant related to User
     */
    const USER_ERROR_NOT_ACTIVE=3;    
    const USER_STATUS_DISABLED=0;
    const USER_STATUS_ACTIVE=1;
    
    
    
    public static function getUserStatus(){
        return array(
            self::USER_STATUS_DISABLED=>t("Disabled"),
            self::USER_STATUS_ACTIVE=>t("Active"));
    }
                                     
    
    
    const USER_GROUP_ADMIN='Admin';
    const USER_GROUP_EDITOR='Editor';
    const USER_GROUP_REPORTER='Reporter';
    
    
    
    /**
     * Constant related to Object
     * 
     */
    
    const OBJECT_STATUS_PUBLISHED=1;
    const OBJECT_STATUS_DRAFT=2;
    const OBJECT_STATUS_PENDING=3;
    const OBJECT_STATUS_HIDDEN=4;
    
    public static function getObjectStatus(){
        return array(
                 self::OBJECT_STATUS_PUBLISHED=>t("Published"),
                 self::OBJECT_STATUS_DRAFT=>t("Draft"),
                 self::OBJECT_STATUS_PENDING=>t("Pending"),
                 self::OBJECT_STATUS_HIDDEN=>t("Hidden")
                );
    }
        
    const OBJECT_ALLOW_COMMENT=1;
    const OBJECT_DISABLE_COMMENT=2;
    
    public static function getObjectCommentStatus(){
        return array(
                 self::OBJECT_ALLOW_COMMENT=>t("Allow"),
                 self::OBJECT_DISABLE_COMMENT=>t("Disable"),                 
                );
    }
   
    /**
     * Constant related to Transfer
     *         
     */
    const TRANS_ROLE=1;
    const TRANS_PERSON=2;
    const TRANS_STATUS=3;
    
    
     /**
     * Constant related to Menu
     *         
     */
    const MENU_TYPE_PAGE=1;
    const MENU_TYPE_TERM=2;
	const MENU_TYPE_CONTENT=5;
    const MENU_TYPE_URL=3;	
    const MENU_TYPE_STRING=4;
    
    public static function getMenuType(){
        return array(
                 self::MENU_TYPE_URL=>t("Link to URL"),                 
                 self::MENU_TYPE_PAGE=>t("Link to Page"),
                 self::MENU_TYPE_CONTENT=>t("Link to a Content Object"),
                 self::MENU_TYPE_TERM=>t("Link to a Term Page"),                                 
                 self::MENU_TYPE_STRING=>t("String"),
                );
    }
    
    
    /**
     * Constant related to Content List
     *         
     */
    const CONTENT_LIST_TYPE_MANUAL=1;
    const CONTENT_LIST_TYPE_AUTO=2;
   
    
    public static function getContentListType(){
        return array(
                 self::CONTENT_LIST_TYPE_MANUAL=>t("Manual"),                 
                 self::CONTENT_LIST_TYPE_AUTO=>t("Auto"),
                 
                );
    }
    
    const CONTENT_LIST_CRITERIA_NEWEST=1;
    const CONTENT_LIST_CRITERIA_MOST_VIEWED_ALLTIME=2;
   
    
    public static function getContentListCriteria(){
        return array(
                 self::CONTENT_LIST_CRITERIA_NEWEST=>t("Newsest"),                 
                 self::CONTENT_LIST_CRITERIA_MOST_VIEWED_ALLTIME=>t("Most viewed all time"),                 
                );
    }
	
	const CONTENT_LIST_RETURN_DATA_PROVIDER=1;
	const CONTENT_LIST_RETURN_ACTIVE_RECORD=2;
	
	public static function getContentListReturnType(){
        return array(
                 self::CONTENT_LIST_RETURN_DATA_PROVIDER=>t("Data Provider"),                 
                 self::CONTENT_LIST_RETURN_ACTIVE_RECORD=>t("Active Record"),                 
                );
    }
    
    /**
     * Constant related to Page
     *         
     */
    const PAGE_ACTIVE=1;
    const PAGE_DISABLE=2;
    
    public static function getPageStatus(){
        return array(
                 self::PAGE_ACTIVE=>t("Active"),
                 self::PAGE_DISABLE=>t("Disable"),                 
                );
    }
	
	const MALE=1;
    const FEMALE=2;
    
    public static function GetGender(){
        return array(
                 self::MALE=>t("Male"),
                 self::FEMALE=>t("Female"),                 
                );
    }
	
	
	const NONE=1;
	const NO=2;
    const YES=3;

    
    public static function GetResult(){
        return array(
		         self::NONE=>t("None"), 
                 self::NO=>t("No"),
                 self::YES=>t("Yes"),                 
                );
    }
	
	
	const HEAMODYNAMICALLYSTABLE=1;
    const HEAMODYNAMICALLYUNSTABLE=2;
const ONVENTILATORSUPPORT=3;
const DEATH=4;
    
    public static function GetDischargecondition(){
        return array(
                 self::HEAMODYNAMICALLYSTABLE=>t("Haemodynamically Stable"),
                 self::HEAMODYNAMICALLYUNSTABLE=>t("Haemodynamically Unstable"),   
self::ONVENTILATORSUPPORT=>t("On Ventilator Support"),   
self::DEATH=>t("Death"),              
                );
    }
	
	
	
	const DISCHARGESUMMARY=1;
    const DEATHSUMMARY=2;
	const DISCHARGESUMMARYAMA=3;
    
    public static function GetType(){
        return array(
                 self::DISCHARGESUMMARY=>t("DISCHARGE SUMMARY"),
                 
				 self::DISCHARGESUMMARYAMA=>t("DISCHARGE SUMMARY(AMA)"),
				 self::DEATHSUMMARY=>t("DEATH SUMMARY"),                 
                );
    }
	
	const SINGLE=1;
    const MARRIED=2;
    
    public static function GetMaritial(){
        return array(
                 self::SINGLE=>t("Single"),
                 self::MARRIED=>t("Married"),                 
                );
    }
	
	public static function getValue(){
        return array(
                 0=>"0",1=>"1",2=>"2",3=>"3", 4=>"4", 5=>"5", 6=>"6", 7=>"7",8=>"8",9=>"9",10=>"10", 11=>"11", 12=>"12", 13=>"13", 14=>"14",15=>"15",16=>"16",17=>"17", 18=>"18", 19=>"19", 20=>"20", 21=>"21",22=>"22",23=>"23",24=>"24", 25=>"25", 26=>"26", 27=>"27", 28=>"28",29=>"29",30=>"30", 31=>"31",32=>"32",33=>"33",34=>"34", 35=>"35", 36=>"36", 37=>"37", 38=>"38",39=>"39",40=>"40",41=>"41",42=>"42",43=>"43",44=>"44", 45=>"45", 46=>"46", 47=>"47", 48=>"48",49=>"49",50=>"50",
                                  
                );
    }
    
    const PAGE_ALLOW_INDEX=1;
    const PAGE_NOT_ALLOW_INDEX=2;
    
    public static function getPageIndexStatus(){
        return array(
                 self::PAGE_ALLOW_INDEX=>t("Allow index"),
                 self::PAGE_NOT_ALLOW_INDEX=>t("Not allow Index"),                 
                );
    }
    
    const PAGE_ALLOW_FOLLOW=1;
    const PAGE_NOT_ALLOW_FOLLOW=2;
    
    public static function getPageFollowStatus(){
        return array(
                 self::PAGE_ALLOW_FOLLOW=>t("Allow follow"),
                 self::PAGE_NOT_ALLOW_FOLLOW=>t("Not allow follow"),                 
                );
    }
    
    
    const PAGE_BLOCK_ACTIVE=1;
    const PAGE_BLOCK_DISABLE=2;
    
    public static function getPageBlockStatus(){
        return array(
                 self::PAGE_BLOCK_ACTIVE=>t("Active"),
                 self::PAGE_BLOCK_DISABLE=>t("Disable"),                 
                );
    }
    
    /**
     * Constant related to Avatar Size
     */    
    
    const AVATAR_SIZE_96=96;
    const AVATAR_SIZE_23=23;
          
    public static function getAvatarSizes(){
        return array(
            self::AVATAR_SIZE_23=>t("23"),
            self::AVATAR_SIZE_96=>t("96"));
    }
	
	
	
    
}

?>
