<?php

use App\Models\Category;

function getCategory($id)
{
    $category = Category::select('*')->where('id', $id)->first();
    return $category->slug;
}

?>