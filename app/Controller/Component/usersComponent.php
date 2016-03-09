<?php

App::uses('Component', 'Controller');
App::import('Model', 'Users');

class usersComponent extends Component  
{
/* CHANGE THESE VALUES !! */
 public $components = array('Session','Auth');
	
	public function startup(Controller $controller) {
		$this->Controller = $controller;
	}
	
		public function getArtistfollowers($user_id,$limit=Null)
		{
			
			$modelFollowers  = ClassRegistry::init('Followers');
			/// how many followed to artist
		$arrCountartistfollowers = $modelFollowers->find('all',array('fields'=>array('users.user_fname','users.user_lname','users.user_display_name','users.user_id','users.usertype_id','users.user_image'),
		'joins' => array(
			array(
				'table' => 'users',
				'alias' => 'users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('Followers.user_id = users.user_id')
				)
			),
		'conditions'=>array('Followers.artist_id'=>$user_id),'limit'=>$limit));
		
				return $arrCountartistfollowers;
		}
		
		
		public function getcountArtistfollowers($user_id)
		{
			$modelFollowers  = ClassRegistry::init('Followers');
			
				$arrCountartistfollowers = $modelFollowers->find('count',
				array(
				'joins' => array(
			array(
				'table' => 'users',
				'alias' => 'users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('Followers.user_id = users.user_id')
				)
			),'conditions'=>array('Followers.artist_id'=>$user_id)));
		
				return $arrCountartistfollowers;
		}
		
		
		
		
		public function getArtistLikes($user_id,$limit=Null)
		{
			
				$modelLikes  = ClassRegistry::init('Likes');
				/// how many followed to artist
			$arrCountartistlikes = $modelLikes->find('all',array('fields'=>array('users.user_fname','users.user_lname','users.user_display_name','users.user_id','users.usertype_id','users.user_image'),
		'joins' => array(
			array(
				'table' => 'users',
				'alias' => 'users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('Likes.user_id = users.user_id')
				)
			),'conditions'=>array('Likes.artist_id'=>$user_id),'limit'=>$limit));
			
		
			
					return $arrCountartistlikes;
		}
		
		
		public function getcountArtistLikes($user_id)
		{
			$modelLikes  = ClassRegistry::init('Likes');
			
				$arrCountartistfollowers = $modelLikes->find('count',array('joins' => array(
			array(
				'table' => 'users',
				'alias' => 'users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('Likes.user_id = users.user_id')
				)
			),'conditions'=>array('Likes.artist_id'=>$user_id)));
		
				return $arrCountartistfollowers;
		}
		
		
		public function getuserfollowing($user_id,$limit=Null)
		{
			$modelFollowers  = ClassRegistry::init('Followers');
					$arrArtistfollowing = $modelFollowers->find('all',array('fields'=>array('users.user_fname','users.user_lname','users.user_display_name','users.user_id','users.usertype_id','users.user_image'),
			'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'users',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('Followers.artist_id = users.user_id')
					)
				),
			'conditions'=>array('Followers.user_id'=>$user_id),'limit'=>$limit));
			
			return $arrArtistfollowing;
		}
		
		public function getcountuserfollowing($user_id)
		{
			$modelFollowers  = ClassRegistry::init('Followers');
			
				$arrCountartistfollowers = $modelFollowers->find('count',array(
					'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'users',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('Followers.artist_id = users.user_id')
					)
				),'conditions'=>array('Followers.user_id'=>$user_id)));
		
				return $arrCountartistfollowers;
		}
		
		
		public function myprofile($user_id)
		{
			$modelUsers  = ClassRegistry::init('Users');
			$arrUser_Profile =  $modelUsers->find('first',array( 
   'fields' => array('cat.category_name','subcat.subcategory_name','subsubcat.subsubcategory_name','Users.*'),
	  'joins' => array(
			array(
				'table' => 'subsubcategory',
				'alias' => 'subsubcat',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array('subsubcat.subsubcategory_id = Users.subsubcategory_id')
				),
			array(
				'table' => 'subcategory',
				'alias' => 'subcat',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array(
				 'subcat.subcategory_id = Users.subcategory_id'
				 ),
				 
			),
		 array(
				'table' => 'category',
				'alias' => 'cat',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array(
				 'cat.category_id = Users.category_id'
			),
		 ),
		), 'conditions' =>  array('Users.user_id' => $user_id)));
			
			return $arrUser_Profile;
		}
		
		public function getMyRank($artistid)
		{
			$modelUsers  = ClassRegistry::init('UserMedia');
				$rankingnumber = $modelUsers->find( 'first' ,array( 'fields'=>
				array('count(UserMedia.user_id)*avg(mrate.media_rating)/10 as ranking'),
					'joins' => array(
				array(
					'table' => 'mediarating',
					'alias' => 'mrate',
					'type' => 'left',
					'recursive' => -1,
					'conditions'=> array('UserMedia.usermedia_id = mrate.usermedia_id')
					)
				),'conditions'=>array('UserMedia.user_id'=>$artistid)));
				
				 $totalranknum = round($rankingnumber[0]['ranking']);
				 if($totalranknum>=1000)
				 {
					  $rank = 1;
				 }
				 else if($totalranknum>=500)
				 {
					  $rank = 2;
				 }
				 else
				 {
					  $rank = 3;
				 }
				 
				 return $rank;
		
		}
		
		
		
	}?>