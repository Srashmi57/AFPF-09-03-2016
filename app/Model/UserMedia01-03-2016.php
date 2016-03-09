<?php
	class UserMedia extends AppModel 
	{
		public $name = 'UserMedia';
		public $useTable = 'usermedia';
		
	    public function useraveragemedia($userid,$limit)
		{			
		
		         $condition = "UserMedia.user_id=".$userid;
				
					
	 /* $strQuery ="SELECT UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.cover_id,UserMedia.subsubcategory_id, UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.video_thumbnail,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,usermedia_cover.usermedia_title,usermedia_cover.usermedia_path,
cat.category_name,cat.category_image,users.user_display_name,users.user_fname,users.user_lname,cat.category_name,IFNULL(B.likeCount, 0)as likeCount,IFNULL(C.commentCount,0) as commentCount,IFNULL(D.totalrating,0) as totalrating,DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) AS DiffDate,(IFNULL(totalrating, 0)*0.5+ IFNULL(commentCount, 0)*0.2+ IFNULL(likeCount, 0)*0.3)/DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) as avgrate,subcat.subcategory_name,subsubcat.subsubcategory_name  FROM `appap14_usermedia` as UserMedia 
inner join appap14_category as cat on UserMedia.category_id = cat.category_id
inner join appap14_users as users on UserMedia.user_id = users.user_id
left join appap14_subcategory as subcat on UserMedia.subcategory_id = subcat.subcategory_id
left join appap14_subsubcategory as subsubcat on UserMedia.subsubcategory_id = subsubcat.subsubcategory_id
left join appap14_usermedia as usermedia_cover on UserMedia.cover_id = usermedia_cover.usermedia_id
left join( select usermedia_id, count(IFNULL(usermedia_id, 0)) as likeCount  from appap14_medialikes group by usermedia_id)as B on UserMedia.usermedia_id= B.usermedia_id left join( select usermedia_id, count(IFNULL(usermedia_id, 0)) as commentCount from appap14_mediacomment group by usermedia_id)as C on UserMedia.usermedia_id= C.usermedia_id left join( select usermedia_id,  SUM(IFNULL(media_rating, 0)) as totalrating from appap14_mediarating group by usermedia_id)as D on UserMedia.usermedia_id= D.usermedia_id  where ".$condition." order by 
D.totalrating desc,UserMedia.usermedia_date desc limit $limit"; */
$strQuery ="SELECT UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.cover_id,UserMedia.video_thumbnail, UserMedia.subsubcategory_id,UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,cat.category_name,cat.category_small_image,cat.category_image,IFNULL(D.totalrating,0) as totalrating,users.user_fname,users.user_lname,users.user_display_name,users.user_id,usermedia_cover.usermedia_title,
			usermedia_cover.usermedia_path FROM `appap14_usermedia` as UserMedia 
inner join appap14_category as cat on UserMedia.category_id = cat.category_id
inner join appap14_users as users on UserMedia.user_id = users.user_id
left join appap14_usermedia as usermedia_cover on UserMedia.cover_id = usermedia_cover.usermedia_id
left join( select usermedia_id, SUM(IFNULL(media_rating, 0)) as totalrating from appap14_mediarating group by usermedia_id)as D on UserMedia.usermedia_id= D.usermedia_id where ".$condition." order by 
D.totalrating desc,UserMedia.usermedia_date desc limit $limit";


		$mediadetail = $this->query($strQuery);
		
			return $mediadetail; 
		}
		
		 public function topaveragemedia($condition,$limit)
		{
			
		 /* $strQuery ="SELECT UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.video_thumbnail,UserMedia.cover_id,UserMedia.subsubcategory_id, UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,
cat.category_name,IFNULL(B.likeCount, 0)as likeCount,IFNULL(C.commentCount,0) as commentCount,IFNULL(D.totalrating,0) as totalrating,DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) AS DiffDate,users.user_fname,users.user_lname,users.user_display_name,users.user_id,usermedia_cover.usermedia_title,usermedia_cover.usermedia_path,(IFNULL(totalrating, 0)*0.5+ IFNULL(commentCount, 0)*0.2+ IFNULL(likeCount, 0)*0.3)/DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) as avgrate FROM `appap14_usermedia` as UserMedia 
inner join appap14_category as cat on UserMedia.category_id = cat.category_id
inner join appap14_users as users on UserMedia.user_id = users.user_id
left join appap14_usermedia as usermedia_cover on UserMedia.cover_id = usermedia_cover.usermedia_id
left join( select usermedia_id, count(IFNULL(usermedia_id, 0)) as likeCount from appap14_medialikes group by usermedia_id)as B on UserMedia.usermedia_id= B.usermedia_id left join( select usermedia_id, count(IFNULL(usermedia_id, 0)) as commentCount from appap14_mediacomment group by usermedia_id)as C on UserMedia.usermedia_id= C.usermedia_id left join( select usermedia_id, avg(IFNULL(media_rating, 0)) as totalrating from appap14_mediarating group by usermedia_id)as D on UserMedia.usermedia_id= D.usermedia_id where ".$condition." order by 
avgrate desc,UserMedia.usermedia_date desc limit $limit"; */
      $strQuery ="SELECT UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.cover_id,UserMedia.video_thumbnail, UserMedia.subsubcategory_id,UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,cat.category_name,cat.category_small_image,cat.category_image,IFNULL(D.totalrating,0) as totalrating,users.user_fname,users.user_lname,users.user_display_name,users.user_id,usermedia_cover.usermedia_title,
			usermedia_cover.usermedia_path FROM `appap14_usermedia` as UserMedia 
inner join appap14_category as cat on UserMedia.category_id = cat.category_id
inner join appap14_users as users on UserMedia.user_id = users.user_id
left join appap14_usermedia as usermedia_cover on UserMedia.cover_id = usermedia_cover.usermedia_id
left join( select usermedia_id, SUM(IFNULL(media_rating, 0)) as totalrating from appap14_mediarating group by usermedia_id)as D on UserMedia.usermedia_id= D.usermedia_id where ".$condition." order by 
D.totalrating desc,UserMedia.usermedia_date desc limit $limit";

		$mediadetail = $this->query($strQuery);
			return $mediadetail; 
		}
		
		 public function topuseraveragemedia($condition,$limit)
		{
			
			 /* $strQuery ="SELECT UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.cover_id,UserMedia.video_thumbnail, UserMedia.subsubcategory_id,UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,cat.category_name,cat.category_small_image,cat.category_image,IFNULL(B.likeCount, 0)as likeCount,IFNULL(C.commentCount,0) as commentCount,IFNULL(D.totalrating,0) as totalrating,DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) AS DiffDate,users.user_fname,users.user_lname,users.user_display_name,users.user_id,usermedia_cover.usermedia_title,usermedia_cover.usermedia_path,(IFNULL(totalrating, 0)*0.5+ IFNULL(commentCount, 0)*0.2+ IFNULL(likeCount, 0)*0.3)/DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) as avgrate FROM `appap14_usermedia` as UserMedia 
inner join appap14_category as cat on UserMedia.category_id = cat.category_id
inner join appap14_users as users on UserMedia.user_id = users.user_id
left join appap14_usermedia as usermedia_cover on UserMedia.cover_id = usermedia_cover.usermedia_id
left join( select usermedia_id, count(IFNULL(usermedia_id, 0)) as likeCount from appap14_medialikes group by usermedia_id)as B on UserMedia.usermedia_id= B.usermedia_id left join( select usermedia_id, count(IFNULL(usermedia_id, 0)) as commentCount from appap14_mediacomment group by usermedia_id)as C on UserMedia.usermedia_id= C.usermedia_id left join( select usermedia_id, avg(IFNULL(media_rating, 0)) as totalrating from appap14_mediarating group by usermedia_id)as D on UserMedia.usermedia_id= D.usermedia_id where ".$condition." order by 
avgrate desc,UserMedia.usermedia_date desc limit $limit"; */

			$strQuery ="SELECT UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.cover_id,UserMedia.video_thumbnail, UserMedia.subsubcategory_id,UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,cat.category_name,subcat.subcategory_name,subsubcat.subsubcategory_name,cat.category_small_image,cat.category_image,subcat.subcategory_image,subsubcat.subsubcategory_image,IFNULL(D.totalrating,0) as totalrating,users.user_fname,users.user_lname,users.user_display_name,users.user_id,usermedia_cover.usermedia_title,
			usermedia_cover.usermedia_path FROM `appap14_usermedia` as UserMedia 
inner join appap14_category as cat on UserMedia.category_id = cat.category_id
inner join appap14_users as users on UserMedia.user_id = users.user_id
left join appap14_subcategory as subcat on UserMedia.subcategory_id = subcat.subcategory_id
left join appap14_subsubcategory as subsubcat on UserMedia.subsubcategory_id = subsubcat.subsubcategory_id
left join appap14_usermedia as usermedia_cover on UserMedia.cover_id = usermedia_cover.usermedia_id
left join( select usermedia_id, SUM(IFNULL(media_rating, 0)) as totalrating from appap14_mediarating group by usermedia_id)as D on UserMedia.usermedia_id= D.usermedia_id where ".$condition." order by 
D.totalrating desc,UserMedia.usermedia_date desc limit $limit";

		$mediadetail = $this->query($strQuery);
	/* 	print_r($mediadetail);
		exit(); */
		
			return $mediadetail; 
		}
		 public function topuseraveragemedia007($condition)
		{
			
			 /* $strQuery ="SELECT UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.cover_id,UserMedia.video_thumbnail, UserMedia.subsubcategory_id,UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,cat.category_name,cat.category_small_image,cat.category_image,IFNULL(B.likeCount, 0)as likeCount,IFNULL(C.commentCount,0) as commentCount,IFNULL(D.totalrating,0) as totalrating,DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) AS DiffDate,users.user_fname,users.user_lname,users.user_display_name,users.user_id,usermedia_cover.usermedia_title,usermedia_cover.usermedia_path,(IFNULL(totalrating, 0)*0.5+ IFNULL(commentCount, 0)*0.2+ IFNULL(likeCount, 0)*0.3)/DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) as avgrate FROM `appap14_usermedia` as UserMedia 
inner join appap14_category as cat on UserMedia.category_id = cat.category_id
inner join appap14_users as users on UserMedia.user_id = users.user_id
left join appap14_usermedia as usermedia_cover on UserMedia.cover_id = usermedia_cover.usermedia_id
left join( select usermedia_id, count(IFNULL(usermedia_id, 0)) as likeCount from appap14_medialikes group by usermedia_id)as B on UserMedia.usermedia_id= B.usermedia_id left join( select usermedia_id, count(IFNULL(usermedia_id, 0)) as commentCount from appap14_mediacomment group by usermedia_id)as C on UserMedia.usermedia_id= C.usermedia_id left join( select usermedia_id, avg(IFNULL(media_rating, 0)) as totalrating from appap14_mediarating group by usermedia_id)as D on UserMedia.usermedia_id= D.usermedia_id where ".$condition." order by 
avgrate desc,UserMedia.usermedia_date desc limit $limit"; */

			$strQuery ="SELECT UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.cover_id,UserMedia.video_thumbnail, UserMedia.subsubcategory_id,UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,cat.category_name,subcat.subcategory_name,subsubcat.subsubcategory_name,cat.category_small_image,cat.category_image,subcat.subcategory_image,subsubcat.subsubcategory_image,IFNULL(D.totalrating,0) as totalrating,users.user_fname,users.user_lname,users.user_display_name,users.user_id,usermedia_cover.usermedia_title,
			usermedia_cover.usermedia_path FROM `appap14_usermedia` as UserMedia 
inner join appap14_category as cat on UserMedia.category_id = cat.category_id
inner join appap14_users as users on UserMedia.user_id = users.user_id
left join appap14_subcategory as subcat on UserMedia.subcategory_id = subcat.subcategory_id
left join appap14_subsubcategory as subsubcat on UserMedia.subsubcategory_id = subsubcat.subsubcategory_id
left join appap14_usermedia as usermedia_cover on UserMedia.cover_id = usermedia_cover.usermedia_id
left join( select usermedia_id, SUM(IFNULL(media_rating, 0)) as totalrating from appap14_mediarating group by usermedia_id)as D on UserMedia.usermedia_id= D.usermedia_id where ".$condition." order by 
D.totalrating desc,UserMedia.usermedia_date desc";

		$mediadetail = $this->query($strQuery);
	/* 	print_r($mediadetail);
		exit(); */
		
			return $mediadetail; 
		}
		public function getrecentuploadbyselected($pstring)
		{
		   if($pstring!=""){
			$strQuery ="SELECT UserMedia.usermedia_date,UserMedia.category_id,UserMedia.user_id,UserMedia.usermedia_id,UserMedia.cover_id,UserMedia.video_thumbnail, UserMedia.subsubcategory_id,UserMedia.subcategory_id,UserMedia.usermedia_name,UserMedia.usermedia_title,UserMedia.usermedia_type,UserMedia.usermedia_path,UserMedia.video_id,UserMedia.usermedia_status,UserMedia.cover_id,users.user_fname,users.user_lname,users.user_id,users.user_display_name,cat.category_name,subcat.subcategory_name,subsubcat.subsubcategory_name FROM `appap14_usermedia` as UserMedia INNER JOIN  appap14_users as users ON users.user_id = UserMedia.user_id INNER JOIN appap14_category as cat ON UserMedia.category_id = cat.category_id LEFT JOIN appap14_subcategory as subcat ON UserMedia.subcategory_id = subcat.subcategory_id LEFT JOIN appap14_subsubcategory as subsubcat ON UserMedia.subsubcategory_id = subsubcat.subsubcategory_id WHERE ($pstring) ORDER BY UserMedia.usermedia_date desc LIMIT 0,20";
			$mediadetail = $this->query($strQuery);
			}else{
			$mediadetail = '';
			}
			
			return $mediadetail;
			
		}
		
		
	}
?>