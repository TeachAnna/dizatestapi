<?php


use App\Http\Controllers\Admin\AdminAuth;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Comment\CommentController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Desk\StoreController;
use App\Http\Controllers\Admin\Desk\IndexController;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\Link\LinkController;
use App\Http\Controllers\Admin\Slide\SlideController;
use App\Http\Controllers\Admin\Tab\TabController;
use App\Http\Controllers\Admin\Team\TeamController;
use App\Http\Controllers\Admin\Menu\MenuController;
use App\Http\Controllers\Admin\Item\ItemController;
use App\Http\Controllers\Admin\Accordion\AccordionController;
use App\Http\Controllers\Admin\Video\VideoController;
use App\Http\Controllers\Admin\Reiting\ReitingController;
use App\Http\Controllers\Admin\Response\ResponseController;
use App\Http\Controllers\Admin\Gallery\GalleryController;
// use App\Http\Controllers\Admin\Post\Image\StoreController;
// use App\Http\Controllers\Admin\Desk\Image\StoreController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Subscribe\SubscribeController as AdminSubscribeController;
use App\Http\Controllers\Frontend\CommentController as FrontendCommentController;
use App\Http\Controllers\Frontend\Contact;
use App\Http\Controllers\Frontend\GetPostController;
use App\Http\Controllers\Frontend\GetAccordionController;
use App\Http\Controllers\Frontend\GetVideoController;
use App\Http\Controllers\Frontend\GetResponseController;
use App\Http\Controllers\Frontend\GetReitingController;
use App\Http\Controllers\Frontend\GetLikeController;
use App\Http\Controllers\Frontend\GetSlideController;
use App\Http\Controllers\Frontend\GetCategoryController;
use App\Http\Controllers\Frontend\GetTagController;
use App\Http\Controllers\Frontend\GetTabController;
use App\Http\Controllers\Frontend\GetLinkController;
use App\Http\Controllers\Frontend\GetItemController;
use App\Http\Controllers\Frontend\GetTeamController;
use App\Http\Controllers\Frontend\GetMenuController;
use App\Http\Controllers\Frontend\GetGalleryController;
use App\Http\Controllers\Frontend\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// all these route are protected
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('/admins', [AdminAuth::class, 'admins']);
        Route::post('/logout', [AdminAuth::class, 'logout']);
        Route::post('/change-password', [AdminAuth::class, 'changePassword']);

        // categorys
        Route::group(['prefix' => 'categorys', 'namespace' => 'Category'], function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::post('/', [CategoryController::class, 'store']);
            Route::put('/{category}', [CategoryController::class, 'edit']);
            Route::post('/{category}', [CategoryController::class, 'update']);
            Route::delete('/{category}', [CategoryController::class, 'delete']);
            Route::get('/{search}', [CategoryController::class, 'search']);
        });


        // posts
        Route::group(['prefix' => 'posts', 'namespace' => 'Post'], function () {
            Route::group(['prefix' => 'images', 'namespace' => 'Image'], function () {
                Route::post('/', [StoreController::class, 'store']);
            });
            Route::get('/', [PostController::class, 'index']);
            Route::post('/', [PostController::class, 'store']);
            Route::put('/{post}', [PostController::class, 'edit']);
            Route::post('/update', [PostController::class, 'update']);
            Route::delete('/{post}', [PostController::class, 'delete']);
            Route::get('/{search}', [PostController::class, 'search']);
        });


        Route::group(['prefix' => 'desks', 'namespace' => 'Desk'], function () {
            Route::group(['prefix' => 'images', 'namespace' => 'Image'], function () {
                Route::post('/', [StoreController::class, 'store']);
            });

            Route::get('/', [IndexController::class, 'index']);
            Route::post('/', [StoreController::class, 'store']);
        });

         // tabs
         Route::group(['prefix' => 'tabs', 'namespace' => 'Tab'], function () {
            Route::group(['prefix' => 'images', 'namespace' => 'Image'], function () {
                Route::post('/', [StoreController::class, 'store']);
            });
            Route::get('/', [TabController::class, 'index']);
            Route::post('/', [TabController::class, 'store']);
            Route::put('/{tab}', [TabController::class, 'edit']);
            Route::post('/update', [TabController::class, 'update']);
            Route::delete('/{tab}', [TabController::class, 'delete']);
        });

         // tags
         Route::group(['prefix' => 'tags', 'namespace' => 'Tag'], function () {
            Route::get('/', [TagController::class, 'index']);
            Route::post('/', [TagController::class, 'store']);
            Route::put('/{tag}', [TagController::class, 'edit']);
            Route::post('/update', [TagController::class, 'update']);
            Route::delete('/{tag}', [TagController::class, 'delete']);
        });

         // galleries
         Route::group(['prefix' => 'galleries', 'namespace' => 'Gallery'], function () {
            Route::get('/', [GalleryController::class, 'index']);
            Route::post('/', [GalleryController::class, 'store']);
            Route::put('/{gallery}', [GalleryController::class, 'edit']);
            Route::post('/update', [GalleryController::class, 'update']);
            Route::delete('/{gallery}', [GalleryController::class, 'delete']);
        });

             // links
         Route::group(['prefix' => 'links', 'namespace' => 'Link'], function () {
            Route::get('/', [LinkController::class, 'index']);
            Route::post('/', [LinkController::class, 'store']);
            Route::put('/{link}', [LinkController::class, 'edit']);
            Route::post('/update', [LinkController::class, 'update']);
            Route::delete('/{link}', [LinkController::class, 'delete']);
        });

         // menus
         Route::group(['prefix' => 'menus', 'namespace' => 'Menu'], function () {
            Route::get('/', [MenuController::class, 'index']);
            Route::post('/', [MenuController::class, 'store']);
            Route::put('/{menu}', [MenuController::class, 'edit']);
            Route::post('/{menu}', [MenuController::class, 'update']);
            Route::delete('/{menu}', [MenuController::class, 'delete']);
        });

        // slides
        Route::group(['prefix' => 'slides', 'namespace' => 'Slide'], function () {
            Route::get('/', [SlideController::class, 'index']);
            Route::post('/', [SlideController::class, 'store']);
            Route::put('/{slide}', [SlideController::class, 'edit']);
            Route::post('/update', [SlideController::class, 'update']);
            Route::delete('/{slide}', [SlideController::class, 'delete']);
        });

        // teams
        Route::group(['prefix' => 'teams', 'namespace' => 'Team'], function () {
            Route::get('/', [TeamController::class, 'index']);
            Route::post('/', [TeamController::class, 'store']);
            Route::put('/{team}', [TeamController::class, 'edit']);
            Route::post('/update', [TeamController::class, 'update']);
            Route::delete('/{team}', [TeamController::class, 'delete']);
        });

         // Items
         Route::group(['prefix' => 'items', 'namespace' => 'Item'], function () {
            Route::group(['prefix' => 'images', 'namespace' => 'Image'], function () {
                Route::post('/', [StoreController::class, 'store']);
            });
            Route::get('/', [ItemController::class, 'index']);
            Route::post('/', [ItemController::class, 'store']);
            Route::put('/{item}', [ItemController::class, 'edit']);
            Route::post('/update', [ItemController::class, 'update']);
            Route::delete('/{item}', [ItemController::class, 'delete']);
        });

        // setting
        Route::group(['prefix' => 'setting', 'namespace' => 'Setting'], function () {
            Route::get('/', [SettingController::class, 'index']);
            Route::post('/{setting}', [SettingController::class, 'update']);
        });

        // contact
        Route::group(['prefix' => 'contacts', 'namespace' => 'Contact'], function () {
            Route::get('/', [ContactController::class, 'getContacts']);
            Route::delete('/{contact}', [ContactController::class, 'delete']);
        });

        // subscribe
        Route::group(['prefix' => 'subscribe', 'namespace' => 'Subscribe'], function () {
            Route::get('/', [AdminSubscribeController::class, 'index']);
            Route::delete('/{subscribe}', [AdminSubscribeController::class, 'delete']);
        });

        // comments
        Route::group(['prefix' => 'comments', 'namespace' => 'Comment'], function () {
            Route::get('/', [CommentController::class, 'getComments']);
            Route::delete('/{comment}', [CommentController::class, 'delete']);
        });

                 // accordion
         Route::group(['prefix' => 'accordions', 'namespace' => 'Accordion'], function () {
            Route::get('/', [AccordionController::class, 'index']);
            Route::post('/', [AccordionController::class, 'store']);
            Route::put('/{accordion}', [AccordionController::class, 'edit']);
            Route::post('/update', [AccordionController::class, 'update']);
            Route::delete('/{accordion}', [AccordionController::class, 'delete']);
        });

                 // videos
         Route::group(['prefix' => 'videos', 'namespace' => 'Video'], function () {
            Route::get('/', [VideoController::class, 'index']);
            Route::post('/', [VideoController::class, 'store']);
            Route::put('/{video}', [VideoController::class, 'edit']);
            Route::post('/update', [VideoController::class, 'update']);
            Route::delete('/{video}', [VideoController::class, 'delete']);
        });

                 // Responses
         Route::group(['prefix' => 'responses', 'namespace' => 'Response'], function () {
            Route::get('/', [ResponseController::class, 'index']);
            Route::post('/', [ResponseController::class, 'store']);
            Route::put('/{response}', [ResponseController::class, 'edit']);
            Route::post('/update', [ResponseController::class, 'update']);
            Route::delete('/{response}', [ResponseController::class, 'delete']);
        });

    });
});
  Route::post('/login', [AdminAuth::class, 'login']);




  Route::group(['prefix' => 'front', 'namespace' => 'Frontend'], function () {
    Route::get('/single-categorys/{id}', [GetCategoryController::class, 'show']);
    Route::get('/single-tags/{id}', [GetTagController::class, 'show']);
    Route::get('/single-posts/{slug}', [GetPostController::class, 'show']);
    Route::get('/all-categorys', [GetCategoryController::class, 'index']);
    Route::get('/all-posts', [GetPostController::class, 'index']);
    Route::get('/all-slides', [GetSlideController::class, 'index']);
    Route::get('/all-links', [GetLinkController::class, 'index']);
    Route::get('/all-tabs', [GetTabController::class, 'index']);
    Route::get('/all-galleries', [GetGalleryController::class, 'index']);
    Route::get('/all-items', [GetItemController::class, 'index']);
    Route::get('/all-menus', [GetMenuController::class, 'index']);
    Route::get('/all-teams', [GetTeamController::class, 'index']);
    Route::get('/all-tags', [GetTagController::class, 'index']);
    Route::get('/all-accordions', [GetAccordionController::class, 'index']);
    Route::get('/all-videos', [GetVideoController::class, 'index']);
    Route::get('/all-likes', [GetLikeController::class, 'index']);
    Route::get('/all-reitings', [GetReitingController::class, 'index']);
    Route::get('/all-responses', [GetResponseController::class, 'index']);
    // Route::get('/categorys', [GetPostController::class, 'categorys']);
    Route::get('/popular-posts', [GetPostController::class, 'popularPost']);
    Route::get('/latest-posts', [GetPostController::class, 'latestPost']);
    Route::get('/category-posts/{id}', [GetPostController::class, 'getPostByCategory']);
    Route::get('/tag-posts/{id}', [GetPostController::class, 'getPostByTag']);
    // Route::get('/search-posts/{search}', [GetPostController::class, 'searchPost']);
    Route::post('/contact', [Contact::class, 'store']);
    Route::post('/subscribe', [SubscribeController::class, 'store']);
    Route::get('/comments/{id}', [FrontendCommentController::class, 'getComments']);
    Route::post('/comments/{id}', [FrontendCommentController::class, 'store']);
    Route::get('/likes/{id}', [GetLikeController::class, 'getLikes']);
    Route::post('/likes/{id}', [GetLikeController::class, 'store']);
    Route::get('/reitings/{id}', [GetReitingController::class, 'getReitings']);
    Route::post('/reitings/{id}', [GetReitingController::class, 'store']);
    Route::get('/setting', [SettingController::class, 'index']);
});
