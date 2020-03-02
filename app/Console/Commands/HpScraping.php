<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade as GoutteFacade;
use Illuminate\Support\Facades\Validator;
use App\HpImage;

class HpScraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:hp_scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        // MM9  
            $blogUrl = 'https://ameblo.jp/morningmusume-9ki/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }

            
        // MM10.11
            $blogUrl = 'https://ameblo.jp/morningmusume-10ki/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);

            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }    
            
        // MM12 
            $blogUrl = 'https://ameblo.jp/mm-12ki/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }
            
        // MM13.14
            $blogUrl = 'https://ameblo.jp/morningm-13ki/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }
            
        // MM15
            $blogUrl = 'https://ameblo.jp/morningmusume15ki/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }
            
        // A2
            $blogUrl = 'https://ameblo.jp/angerme-amerika/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            } 
        
        // A3456
            $blogUrl = 'https://ameblo.jp/angerme-ss-shin/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            } 
            
        // A78
            $blogUrl = 'https://ameblo.jp/angerme-new/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }    
            
            
        // JJ
            $blogUrl = 'https://ameblo.jp/juicejuice-official/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }
            
        // KF
            $blogUrl = 'https://ameblo.jp/kobushi-factory/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }      
            
        // TF
            $blogUrl = 'https://ameblo.jp/tsubaki-factory/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            } 
            
        // CCTT
            $blogUrl = 'https://ameblo.jp/beyooooonds-chicatetsu/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            } 
            
        // RFRO
            $blogUrl = 'https://ameblo.jp/beyooooonds-rfro/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            } 
            
        // BY
            $blogUrl = 'https://ameblo.jp/beyooooonds/entrylist.html';
            $blogUrls = $this->getDetailBlogUrls($blogUrl);
        
            foreach ($blogUrls as $eachBlogUrl) {
                $this->saveHpImagesFromBlogUrl($eachBlogUrl);
            }     
            
           

    }
    
    public function saveHpImagesFromBlogUrl($eachBlogUrl) {
        $goutte = GoutteFacade::request('GET', $eachBlogUrl);
        
        $images = [];
        $goutte->filter('.PhotoSwipeImage')->each(function ($node) use (&$images) {
            $images[] = $node->attr('src');
        });
        
        $length = strlen($eachBlogUrl);  #11文字ある
        $diffLeng = $length - 16;
        $time = substr($eachBlogUrl, $diffLeng, 11);
        
        foreach ($images as $image) {
            $saveData = [
                'user_id' => 1,
                'image_url' => $image,
                'blog_url' => $eachBlogUrl,
                'update_time' => $time,
                'is_favorite' => false,
                
            ];
            
            $validator = Validator::make($saveData, [
                'image_url' => 'required|unique:hp_images,image_url',
            ]);
            
            if ($validator->fails()) {
                continue;
            }
            
            $hpImage = new HpImage;
            $hpImage->fill($saveData)->save();
        
        }
        return;
        
    }
    
    public function getDetailBlogUrls($blogUrl) {
        
        $goutte = GoutteFacade::request('GET', $blogUrl);
        
        $blogs = [];
        $goutte->filter('ul.skin-archiveList > li.skin-borderQuiet h2 > a')->each(function ($node) use (&$blogs) {
            $blogs[] = 'https://ameblo.jp'.$node->attr('href');
        });
        
        return $blogs;
    }
}

