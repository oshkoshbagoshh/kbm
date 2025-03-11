<?php
$articles = [
    [
        "title" => "Top 10 Quick Meal Prep Tips for Busy Moms",
        "content" => "This article explores quick and easy meal prep tips for busy moms...",
        "influencer" => [
            "name" => "Janelle",
            "email" => "janelle.nowroozi@gmail.com",
            "bio" => "Janelle is a 34-year-old mother of a 1-year-old...",
            "product_group" => "Mom_A, Women_A"
        ]
    ],
    [
        "title" => "The Best Kitchen Gadgets for Home Cooks",
        "content" => "Discover the best kitchen gadgets that every home cook needs...",
        "influencer" => [
            "name" => "Jeff",
            "email" => "klutchsocialmedia@gmail.com",
            "bio" => "Jeff is a 36-year-old single male living in Milwaukee...",
            "product_group" => "Men_A"
        ]
    ]
];

foreach ($articles as $article) {
    echo "
    <div class='bg-white shadow-lg rounded-lg p-6'>
        <h2 class='text-xl font-semibold text-gray-900 mb-4'>{$article['title']}</h2>
        <p class='text-gray-700 mb-4'>{$article['content']}</p>
        <div class='border-t pt-4'>
            <h3 class='text-lg font-semibold text-gray-800'>Influencer</h3>
            <p class='text-gray-600'><span class='font-medium'>Name:</span> {$article['influencer']['name']}</p>
            <p class='text-gray-600'><span class='font-medium'>Email:</span> {$article['influencer']['email']}</p>
            <p class='text-gray-600'><span class='font-medium'>Bio:</span> {$article['influencer']['bio']}</p>
            <p class='text-gray-600'><span class='font-medium'>Product Group:</span> {$article['influencer']['product_group']}</p>
        </div>
    </div>
    ";
}
