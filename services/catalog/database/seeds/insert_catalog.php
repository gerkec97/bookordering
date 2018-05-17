<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class insert_catalog extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalog')->insert($this->getBooks());
    }


    private function getBooks()
    {
        $books = json_decode('[
        {
            "title": "Programming LEGO EV3 My Blocks",
            "subtitle": "Teaching Concepts and Preparing for FLL Competition",
            "isbn13": "9781484234372",
            "price": "$14.99",
            "image": "https://itbook.store/img/books/9781484234372.png",
            "url": "https://itbook.store/books/9781484234372"
        },
        {
            "title": "Deep Learning with Applications Using Python",
            "subtitle": "Chatbots and Face, Object, and Speech Recognition With TensorFlow and Keras",
            "isbn13": "9781484235157",
            "price": "$35.99",
            "image": "https://itbook.store/img/books/9781484235157.png",
            "url": "https://itbook.store/books/9781484235157"
        },
        {
            "title": "Pro Entity Framework Core 2 for ASP.NET Core MVC",
            "subtitle": "",
            "isbn13": "9781484234341",
            "price": "$51.61",
            "image": "https://itbook.store/img/books/9781484234341.png",
            "url": "https://itbook.store/books/9781484234341"
        },
        {
            "title": "Introduction to Deep Learning Business Applications for Developers",
            "subtitle": "From Conversational Bots in Customer Service to Medical Image Processing",
            "isbn13": "9781484234525",
            "price": "$29.99",
            "image": "https://itbook.store/img/books/9781484234525.png",
            "url": "https://itbook.store/books/9781484234525"
        },
        {
            "title": "Beginning Robotics with Raspberry Pi and Arduino",
            "subtitle": "Using Python and OpenCV",
            "isbn13": "9781484234617",
            "price": "$24.98",
            "image": "https://itbook.store/img/books/9781484234617.png",
            "url": "https://itbook.store/books/9781484234617"
        },
        {
            "title": "Pro PowerShell Desired State Configuration, 2nd Edition",
            "subtitle": "An In-Depth Guide to Windows PowerShell DSC",
            "isbn13": "9781484234822",
            "price": "$49.97",
            "image": "https://itbook.store/img/books/9781484234822.png",
            "url": "https://itbook.store/books/9781484234822"
        },
        {
            "title": "Learn Rails 5.2",
            "subtitle": "Accelerated Web Development with Ruby on Rails",
            "isbn13": "9781484234884",
            "price": "$38.78",
            "image": "https://itbook.store/img/books/9781484234884.png",
            "url": "https://itbook.store/books/9781484234884"
        },
        {
            "title": "Neural Networks for Electronics Hobbyists",
            "subtitle": "A Non-Technical Project-Based Introduction",
            "isbn13": "9781484235065",
            "price": "$19.99",
            "image": "https://itbook.store/img/books/9781484235065.png",
            "url": "https://itbook.store/books/9781484235065"
        },
        {
            "title": "Office 365 for Healthcare Professionals",
            "subtitle": "Improving Patient Care Through Collaboration, Compliance, and Productivity",
            "isbn13": "9781484235485",
            "price": "$33.54",
            "image": "https://itbook.store/img/books/9781484235485.png",
            "url": "https://itbook.store/books/9781484235485"
        },
        {
            "title": "Practical Web Scraping for Data Science",
            "subtitle": "Best Practices and Examples with Python",
            "isbn13": "9781484235812",
            "price": "$36.37",
            "image": "https://itbook.store/img/books/9781484235812.png",
            "url": "https://itbook.store/books/9781484235812"
        }
    ]', true);


        $transformed  = array_map(function($el) {
            return [
                'title' => $el['title'],
                'isbn' => $el['isbn13'],
                'price' => preg_replace('/[^0-9.]/', '', $el['price'])
            ];
        }, $books);

        return $transformed;
    }

}
