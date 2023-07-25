<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'اطلاعات ورود صحیح نمی‌باشد.',
    'throttle' => 'تعداد دفعات تلاش برای ورود از حد مجاز بیشتر است. لطفا پس از  :seconds ثانیه مجددا تلاش فرمایید.',

    'GET_api/admin/categories' => "لیست دسته بندی ها",
    'POST_api/admin/categories' => "افزودن دسته بندی",
    'GET_api/admin/categories/{category}' => "نمایش جزئیات دسته بندی",
    'PUT_api/admin/categories/{category}' => 'ویرایش دسته بندی',
    'DELETE_api/admin/categories/{category}' => 'حذف دسته بندی',

    'GET_api/admin/products/shops' => 'لیست قیمت ها',
    'POST_api/admin/products/shops' => 'افزودن لیست قیمت',
    'GET_api/admin/products/shops/{shop}' => 'نمایش جزئیات لیست قیمت',
    'PUT_api/admin/products/shops/{shop}' => 'ویرایش جزئیات لیست قیمت',
    'DELETE_api/admin/products/shops/{shop}' => 'حذف لیست قیمت',

    'GET_api/admin/products/images' => "عکس محصوات",
    'POST_api/admin/products/images' => 'افزودن عکس محصول',
    'GET_api/admin/products/images/{image}' => "جزئیات عکس محصول ",
    'PUT_api/admin/products/images/{image}' => 'ویرایش عکس محصول',
    'DELETE_api/admin/products/images/{image}' => 'حذف تصویر محصول',

    'GET_api/admin/products/quantities' => 'مقدار محصولات',
    'POST_api/admin/products/quantities' => 'افزودن مقدار محصولات',
    'PUT_api/admin/products/quantities/{products}' => 'ویرایش مقدار محصولات',

    'GET_api/admin/products/categories' => 'مدیریت دسته بندی کالا',
    'POST_api/admin/products/categories' => 'افزودن دسته بندی کالا',
    'GET_api/admin/products/categories/{category}' => 'جزئیات دسته بندی کالا',
    'DELETE_api/admin/products/categories/{category}' => 'حذف دسته بندی کالا',

    'POST_api/admin/products/quantities/import' => 'ورود دسته ای اطلاعات',
    'PUT_api/admin/products/quantities/{quantity}' => 'ویرایش موجودی',

    'GET_api/admin/products' => 'مشاهده محصولات',
    'POST_api/admin/products' => 'افزودن محصول',
    'GET_api/admin/products/{product}' => 'نمایش جزئیات محصول',
    'PUT_api/admin/products/{product}' => 'ویرایش محصول',
    'DELETE_api/admin/products/{product}' => 'حذف محصول',

    'GET_api/admin/orders/histories' => 'وضعیت سفارشات',
    'POST_api/admin/orders/histories' => 'ویرایش وضعیت سفارشات',
    'GET_api/admin/orders' => 'سفارشات',
    'GET_api/admin/orders/{order}' => 'جزئیات سفارشات',

    'GET_api/admin/users' => 'لیست اعظاء',
    'GET_api/admin/users/{user}' => 'جزئیات اعضاء',
    'PUT_api/admin/users/{user}' => 'ویرایش اعضاء',

    'GET_api/admin/authorizations' => 'نمایش دسترسی ها',
    'POST_api/admin/authorizations' => 'ثبت دسترسی ها',

];
