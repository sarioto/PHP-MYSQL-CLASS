<?php
	include_once('MySQL.php');
	
	$mysql = new MySQL('host', 'user', 'password', 'database');
	
	// get all posts
	try{
		$posts = $mysql->get('posts');
		print_r($posts);
		echo $mysql->num_rows(); // number of rows returned
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	
	// get all post titles and authors
	try{
		$posts = $mysql->get('posts', array('title', 'author'));
		// or
		$posts = $mysql->get('posts', 'title,author');
		print_r($posts);
		echo $mysql->last_query(); // the raw query that was ran
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	
	// get one post
	try{
		$post = $mysql->limit(1)->get('posts');
		print_r($post);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	// get offset 5 row
	try{
		$post = $mysql->offset(5)->get('posts');
		print_r($post);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	// get post after offset 10 rowes
	try{
		$post = $mysql->offset(10)->get('posts');
		print_r($post);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	
	// get post with an id of 1
	try{
		$post = $mysql->where('id', 1)->get('posts');
		// or
		$post = $mysql->where(array('id', 1))->get('posts');
		print_r($post);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	
	// get all posts by the author of "John Doe"
	try{
		$posts = $mysql->where(array('author' => 'John Doe'))->get('posts');
		print_r($posts);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}

    // get all posts by the author of "John Doe" and author name
    // available join methods 'join' (inner join), 'leftJoin', 'rightJoin', 'crossJoin'
	try{
		$posts = $mysql->where(array('author' => 'John Doe'))->join('authors', 'AND')->get('posts', ['posts.*', 'author.name']);
		print_r($posts);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
                             
                             
	// insert post
	try{
		$mysql->insert('posts', array('title' => 'New Title', 'content' => 'post content', 'author' => 'Matthew Loberg'));
		echo $mysql->insert_id(); // id of newly inserted post
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	
	// update post 1
	try{
		$mysql->where('id', 1)->update('posts', array('title' => 'New Title'));
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	
	// delete post 1
	try{
		$mysql->where('id', 1)->delete('posts');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}