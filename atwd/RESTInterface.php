<?php
interface RESTInterface{
	public function restGet($urlSegment);
    public function restPut($urlSegment);
    public function restDelete($urlSegment);
    public function restPost($urlSegment);
}