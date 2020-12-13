<?php
// テーマのセットアップ

function my_setup(){
    add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
    add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
    add_theme_support('title-tag'); // タイトルタグ自動生成
    add_theme_support(
    'html5',
    array( //HTML5でマークアップ
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        )
    );
}

add_action('after_setup_theme','my_setup');

/**
* CSSとJavaScriptの読み込み
*/
function my_script_init()
{
wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', array(), '5.8.2', 'all');
wp_enqueue_style('my', get_template_directory_uri() . '/css/style.css?ver'.time(), array(), '1.0.0', 'all');
wp_enqueue_script('my', get_template_directory_uri() . '/js/script.js?ver'.time(), array( 'jquery' ), '1.0.0', true);

// 投稿記事画面（シングルページ)のみSNSシェアを表示する
if(is_single()){
    wp_enqueue_script('sns', get_template_directory_uri().'/js/sns.js?ver'.time(), array('jquery'), '1.0.0', true);
}

//コードハイライト用
if ( is_singular() ) {
    wp_enqueue_style( 'hljs-style', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.5.0/styles/monokai-sublime.min.css' );
    wp_enqueue_script( 'hljs-script', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.5.0/highlight.min.js', array(), null, true );
    wp_add_inline_script( 'hljs-script', 'hljs.initHighlightingOnLoad();' );
}
}
add_action('wp_enqueue_scripts', 'my_script_init');

/**
* メニューの登録
*/
function my_menu_init(){
    register_nav_menus(
        array(
            'global' => 'ヘッダーメニュー',
            'footer' => 'フッターメニュー',
            'drawer' => 'ドロワーメニュー',
        )
        );
}
add_action('init','my_menu_init');


/**
* アーカイブタイトル書き換え
*
* @param string $title 書き換え前のタイトル.
* @return string $title 書き換え後のタイトル.
*/

function my_archive_title($title){
    if(is_category()){ //カテゴリーアーカイブの場合
        $title = ''.single_cat_title('',false).'';
    } elseif(is_tag()){ //タグアーカイブの場合
        $title = ''.single_tag_title('',false).'';
    } elseif(is_post_type_archive()){   //投稿タイプのアーカイブの場合
        $title = ''.post_type_archive_title('',false).'';
    } elseif(is_tax()){ //タームアーカイブの場合
        $title =''.single_term_title('',false).'';
    } elseif (is_author()){  //作者アーカイブの場合
        $title = ''.get_the_author().'';
    } elseif (is_date()){   //日付アーカイブの場合
        $title = '';
        if( get_query_var('year')){
            $title .= get_query_var('year').'年';
        }
        if( get_query_var('monthnum')){
            $title .= get_query_var('monthnum').'月';
        }
        if( get_query_var('day')){
            $title .= get_query_var('day').'年';
        }
    }
    return $title;
};
add_filter('get_the_archive_title','my_archive_title');


/**
* カテゴリータイトル書き換え
*
* @param string $title 書き換え前のタイトル.
* @return string $title 書き換え後のタイトル.
*/

function my_category_title($title){
    if(is_category()){ //カテゴリーアーカイブの場合
        $title = ''.single_cat_title('',false).'';
    } elseif(is_tag()){ //タグアーカイブの場合
        $title = ''.single_tag_title('',false).'';
    } elseif(is_post_type_archive()){   //投稿タイプのアーカイブの場合
        $title = ''.post_type_archive_title('',false).'';
    } elseif(is_tax()){ //タームアーカイブの場合
        $title =''.single_term_title('',false).'';
    } elseif (is_author()){  //作者アーカイブの場合
        $title = ''.get_the_author().'';
    } elseif (is_date()){   //日付アーカイブの場合
        $title = '';
        if( get_query_var('year')){
            $title .= get_query_var('year').'年';
        }
        if( get_query_var('monthnum')){
            $title .= get_query_var('monthnum').'月';
        }
        if( get_query_var('day')){
            $title .= get_query_var('day').'年';
        }
    }
    return $title;
};
add_filter('get_the_category_title','my_category_title');


/**
* カテゴリーを1つだけ表示
*
* @param boolean $anchor aタグで出力するかどうか.
* @param integer $id 投稿id.
* @return void
*/

function my_the_post_category( $anchor = true, $id = 0 ) {
    global $post;
    //引数が渡されなければ投稿IDを見るように設定
    if ( 0 === $id ) {
        $id = $post->ID;
    }

    //カテゴリー一覧を取得
    $this_categories = get_the_category( $id );
    if ( $this_categories[0] ) {
        if ( $anchor ) { //引数がtrueならリンク付きで出力
            echo '<a href="' . esc_url( get_category_link( $this_categories[0]->term_id ) ) . '">' . esc_html( $this_categories[0]->cat_name ) . '</a>';
        } else { //引数がfalseならカテゴリー名のみ出力
            echo esc_html( $this_categories[0]->cat_name );
        }
    }
}


/**
* タグ一覧の取得
*
*/

function my_get_post_tags( $id = 0 ) {
    global $post;
    //引数が渡されなければ投稿IDを見るように設定
    if ( 0 === $id ) {
        $id = $post->ID;
    }

    //タグ一覧を取得
    // $tags = get_the_tags( $id );
    // if (isset( $tags )) {
    //     foreach ($tags as $tag) {
    //         echo '<div class="entry-tag-item"><a href="' .esc_url( get_tag_link( $tag->term_id)). '">'. esc_html($tag->name).'</a></div>';
    //     }
    // }
}


/**
* ウィジェットの登録
*/
function my_widget_init() {
    register_sidebar(
        array(
            'name' => 'サイドバー', //表示するエリア名
            'id' => 'sidebar', //id
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
        )
    );
}
add_action( 'widgets_init', 'my_widget_init' );


/**
*
*   ショートコード
*
*/
//ショートコードの基本
function hello_func(){
    return "hello shortcode!";
}
add_shortcode('hello', 'hello_func');

//ショートコードでユーザーが入力した属性の値を出力
function userword_func( $atts ) {
    $atts = shortcode_atts(
        array(
            'word' => '値が入力されていません',
        ), $atts, 'userword' );
    return $atts['word'];
}
add_shortcode( 'userword', 'userword_func' );

//ショートコードでユーザーが入力した属性の値を出力（複数）
function multiple_userword_func( $atts ) {
    $atts = shortcode_atts(
        array(
            'word1' => 'word1の値が入力されていません',
            'word2' => 'word2の値が入力されていません',
        ), $atts, 'multiple' );
    return $atts['word1'] . $atts['word2'];
}
add_shortcode( 'multiple', 'multiple_userword_func' );

//ショートコードでユーザーが入力した属性の値を税込にして出力
function tax_func( $atts ) {
    $atts = shortcode_atts(
        array(
            'price' => '金額が入力されていません',
        ), $atts, 'tax' );
    if(ctype_digit($atts['price'])):    //入力した内容が数値なら
        return $atts['price'] * 1.08;   //税込み価格を返す
    else:
        return $atts['price'];          //でなければ何もせず返す
    endif;
}
add_shortcode( 'tax', 'tax_func' );



//囲み型ショートコードで出力
function kakomi_func( $atts, $content = null ) {
    return $content;
}
add_shortcode('kakomi', 'kakomi_func');

//クラスをつけて出力
function box_func( $atts, $content = null ){
    return '<div style="background-color: #fcc; padding: 20px; border: 1px solid red;">' . $content . '</div>';
}
add_shortcode('box', 'box_func');


//ボタンのショートコード
function my_shortcode( $atts, $content = '' ) {
    return '<div class="entry-btn"><a class="btn" href="' . $atts['link'] . '">' . $content . '</a></div><!-- /entry-btn -->';
}
add_shortcode( 'btn', 'my_shortcode' );




/**
* カスタムフィールドを使ってアクセス数を取得する（特定記事のアクセス数確認用）
*
* @param integer $id 投稿id.
* @return void
*/
//アクセス数を取得
function get_post_views( $id = 0 ){
    global $post;
    //引数が渡されなければ投稿IDを見るように設定
    if ( 0 === $id ) {
        $id = $post->ID;
    }
    $count_key = 'view_counter';
    $count = get_post_meta($id, $count_key, true);

    if($count === ''){
        delete_post_meta($id, $count_key);
        add_post_meta($id, $count_key, '0');
    }
    return $count;
}

/**
* アクセスカウンター
*
* @return void
*/
function set_post_views() {
    global $post;
    $count = 0;
    $count_key = 'view_counter';

    if( $post ){
        $id = $post->ID;
        $count = get_post_meta($id, $count_key, true);
    }

    if( $count === '' ){
        delete_post_meta($id, $count_key);
        add_post_meta($id, $count_key, '1');
    } elseif( $count > 0 ){
        // if(!is_user_logged_in()){ //管理者（自分）の閲覧を除外
        $count++;
        update_post_meta($id, $count_key, $count);
        // }
    }
    //$countが0のままの場合（404や該当記事の検索結果が0件の場合）は何もしない
}
add_action( 'template_redirect', 'set_post_views', 10 );




/**

* 検索結果から固定ページを除外する

* @param string $search SQLのWHERE句の検索条件文

* @param object $wp_query WP_Queryのオブジェクト

* @return string $search 条件追加後の検索条件文

*/
function my_posts_search( $search, $wp_query ){

    //検索結果ページ・メインクエリ・かつ管理画面以外の場合
    if ( $wp_query->is_search() && $wp_query->is_main_query() && !is_admin() ){
        // 検索結果を投稿タイプに絞る
        $search .= " AND post_type = 'post' ";
        return $search;
    }
    return $search;
}
add_filter('posts_search','my_posts_search', 10, 2);



?>
