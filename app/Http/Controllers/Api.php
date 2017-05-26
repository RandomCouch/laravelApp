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
    
    public function getHomepage(){
    	$sideBarLinks = array();
    	return view('home', ['title' => 'Home', 'sideLinks' => $sideBarLinks]);
    }
    
    public function getUsers($userID = null)
	{
		$query;
		$sideBarLinks = array();
		if(isset($userID)){
			$query = 'SELECT users.id, users.username, users.email, user_roles.label as user_role,'
					 .' user_addresses.address, user_addresses.province, user_addresses.city, user_addresses.country, user_addresses.postal_code,'
					 .' (SELECT COUNT(*) FROM blog_posts WHERE author=users.id) as post_count FROM users' 
					 .' LEFT JOIN user_roles ON users.user_roles_id=user_roles.id'
					 .' LEFT JOIN user_addresses ON users.id=user_addresses.user_id'
					 .' WHERE users.id=' . $userID;
					 
			$users = \DB::select($query);
			
			return view('viewUser', ['title' => 'View User', 'sideLinks' => $sideBarLinks, 'user' => $users[0]]);
		}else{
			$query = 'SELECT users.id, users.username, users.email, user_roles.label as user_role,'
					 .' user_addresses.address, user_addresses.province, user_addresses.city, user_addresses.country, user_addresses.postal_code,'
					 .' (SELECT COUNT(*) FROM blog_posts WHERE author=users.id) as post_count FROM users' 
					 .' LEFT JOIN user_roles ON users.user_roles_id=user_roles.id'
					 .' LEFT JOIN user_addresses ON users.id=user_addresses.user_id';
					 
			$users = \DB::select($query);
			
			return view('users', ['title' => 'Users', 'sideLinks' => $sideBarLinks, 'users' => $users]);
		}
	}
	
	public function getPosts($type = null, $typeID = null)
	{
		$query;
		$extraTitle = "";
		if(isset($type)){
			if(isset($typeID)){
				if($type == "u"){
					$query = 'SELECT blog_posts.*, users.username FROM blog_posts INNER JOIN users ON blog_posts.author=users.id WHERE blog_posts.author='. $typeID;
					$posts = \DB::select($query);
					if(!empty($posts)){
						$username = $posts[0]->username;
						$extraTitle = "by " . $username;
						return view('blog', ['title' => 'Posts by ' . $username, 'posts' => $posts, 'extraTitle' => $extraTitle]);
					}
				}else if($type == "p"){
					$query = 'SELECT blog_posts.*, users.username FROM blog_posts INNER JOIN users ON blog_posts.author=users.id WHERE blog_posts.id='. $typeID;
					$posts = \DB::select($query);
					if(!empty($posts)){
						return view('viewPost', ['title' => 'View Post', 'post' => $posts[0]]);
					}else{
						return view('errors.404');
					}
				}else {
					$query = 'SELECT blog_posts.*, users.username FROM blog_posts INNER JOIN users ON blog_posts.author=users.id';
				}
			}else{
				$query = 'SELECT blog_posts.*, users.username FROM blog_posts INNER JOIN users ON blog_posts.author=users.id';
			}
		}else{
			$query = 'SELECT blog_posts.*, users.username FROM blog_posts INNER JOIN users ON blog_posts.author=users.id';
		}
		
		$query .= " ORDER by blog_posts.created_at";
		$posts = \DB::select($query);
		
		return view('blog', ['title' => 'Blog', 'posts' => $posts, 'extraTitle' => $extraTitle]);
	}
	
	public function createPostForm()
	{
		$users = \DB::table('users')->get();
		
		return view('createPost', ['title' => 'Create Post', 'users' => $users]);
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
			$newID = \DB::table('blog_posts')->insertGetId(['author' => $author, 'title' => $title, 'content' => $content, 'created_at' => $timeNow, 'updated_at' => $timeNow]);
			return redirect()->action('Api@getPosts',['type' => 'p', 'typeID' => $newID])->with('success', ['Blog post created successfully!']);
		}else{
			return redirect()->action('Api@createPost')->with('errors', $errors);
		}
	}
	
	public function editUser(Request $request, $userID){
	    $userData = $request->all();
	    $sideBarLinks = array();
	    $errors = array();
	    
	    $addressData = array();
	    $addressKeys = ['address','province','city','country','postal_code'];
	    if(empty($userData)){
	    	$errors[] = "Missing data";
	    }else{
		    foreach($userData as $key=>$value){
		        if(empty($value)){
		          $errors[] = $key . " is missing";   
		        }
		        if(in_array($key, $addressKeys)){
		            $addressData[$key]=$value;
		            unset($userData[$key]);
		        }
		    }
	    }
	    
	    if(empty($errors)){
	        \DB::table('users')->where('id', $userID)->update($userData);
	        \DB::table('user_addresses')->where('user_id', $userID)->update($addressData);
	        
	        return redirect()->action('Api@getUsers', ['userID' => $userID])->with('success', ['User information updated successfully!']);
	    }else{
	        return redirect()->action('Api@editUserForm',['userID' => $userID])->with('errors', $errors);
	    }
	}
	
	public function editUserForm($userID, $errors = null)
	{
		$sideBarLinks = array();
		$query = 'SELECT users.id, users.username, users.email, user_roles.label as user_role,'
					 .' user_addresses.address, user_addresses.province, user_addresses.city, user_addresses.country, user_addresses.postal_code,'
					 .' (SELECT COUNT(*) FROM blog_posts WHERE author=users.id) as post_count FROM users' 
					 .' LEFT JOIN user_roles ON users.user_roles_id=user_roles.id'
					 .' LEFT JOIN user_addresses ON users.id=user_addresses.user_id'
					 .' WHERE users.id=' . $userID;
		$users = \DB::select($query);
		
		return view('editUser',['title' => "Edit User", 'sideLinks' => $sideBarLinks, 'user' => $users[0], 'errors' => $errors]);
		
	}
}
