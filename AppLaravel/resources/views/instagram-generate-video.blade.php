@extends('layouts.instagram')

@section('content')
    <x-instagram-template 
        :videoTitle="$video->details_video_title" 
        :viewCount="$video->details_video_maxnum ?? '1.000'" 
        :comments="$video->videoComment" 
        :shortCode="$video->details_video_shortcode" 
        :user="$video->user"
        :commentfrequeny="$commentfrequeny"
    />
@endsection
