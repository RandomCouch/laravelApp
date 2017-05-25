<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Api extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getUsers($userID = null)
	{
		$query;
		if(isset($userID)){
			$query = 'SELECT users.username, users.email, user_roles.label as user_role,'
					 .' user_addresses.address, user_addresses.province, user_addresses.city, user_addresses.country, user_addresses.postal_code,'
					 .' (SELECT COUNT(*) FROM blog_posts WHERE author=users.id) as post_count FROM users' 
					 .' LEFT JOIN user_roles ON users.user_roles_id=user_roles.id'
					 .' LEFT JOIN user_addresses ON users.id=user_addresses.user_id'
					 .' WHERE users.id=' . $userID;
		}else{
			$query = 'SELECT users.username, users.email, user_roles.label as user_role,'
					 .' user_addresses.address, user_addresses.province, user_addresses.city, user_addresses.country, user_addresses.postal_code,'
					 .' (SELECT COUNT(*) FROM blog_posts WHERE author=users.id) as post_count FROM users' 
					 .' LEFT JOIN user_roles ON users.user_roles_id=user_roles.id'
					 .' LEFT JOIN user_addresses ON users.id=user_addresses.user_id';
		}
		$users = \DB::select($query);
		
		return json_encode($users);
	}
	
	public function getPosts($type = null, $typeID = null)
	{
		$query;
		if(isset($type)){
			if(isset($typeID)){
				if($type == "u"){
					$query = 'SELECT * FROM blog_posts WHERE author='. $typeID;
				}else if($type == "p"){
					$query = 'SELECT * FROM blog_posts WHERE id='. $typeID;
				}else {
					$query = 'SELECT * FROM blog_posts';
				}
			}else{
				$query = 'SELECT * FROM blog_posts';
			}
		}else{
			$query = 'SELECT * FROM blog_posts';
		}
		$posts = \DB::select($query);
		return json_encode($posts);
	}
	
	public function createPost(Request $request){
		$author = $request->get('author');
		$title = $request->get('title');
		$content = $request->get('content');
		$timeNow = date('Y-m-d H:i:s');
		
		$errors = array();
		if(empty($author)){ $errors[] = "Author ID is missing"; }
		if(empty($title)){ $errors[] = "Post title is missing"; }
		if(empty($content)){ $errors[] = "Post content is missing"; }
		
		if(empty($errors)){
			\DB::table('blog_posts')->insert(['author' => $author, 'title' => $title, 'content' => $content, 'created_at' => $timeNow, 'updated_at' => $timeNow]);
			$results = ['type' => 'success', 'message' => 'Blog post created successfully!'];
			return json_encode($results);
		}else{
			$results = ['type' => 'error', 'errors' => $errors];
			return json_encode($results);
		}
	}
	
	public function editUser(Request $request, $userID){
	    $userData = $request->all();
	    
	    $errors = array();
	    
	    
	    $addressData = array();
	    $addressKeys = ['address','province','city','country','postal_code'];
	    foreach($userData as $key=>$value){
	        if(empty($value)){
	          $errors[] = $key . " is missing";   
	        }
	        if(in_array($key, $addressKeys)){
	            $addressData[$key]=$value;
	            unset($userData[$key]);
	        }
	    }
	    
	    if(empty($errors)){
	        \DB::table('users')->where('id', $userID)->update($userData);
	        \DB::table('user_addresses')->where('user_id', $userID)->update($addressData);
	        
	        $results = ['type' => 'success', 'message' => 'User information updated successfully!'];
	        return json_encode($results);
	    }else{
	        $results = ['type' => 'error', 'errors' => $errors];
			return json_encode($results);
	    }
	}
}
