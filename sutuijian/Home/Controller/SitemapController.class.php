<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 活动相关 类文件 
 * 
 * @author      sunyue<1551058861@qq.com> 
 * @since       1.0 
 */
class SitemapController extends Controller {

        public function __construct() {
                
        }

        /**
         * 生成sitemaps.xml页面  
         * 
         * @access public 
         * @since 1.0 
         */
        function create_sitemaps() {

                //更新时间
                $a=filemtime("sitemap1.xml");
                $date1 = date("Y-m-d H:i:s",$a);
                $b=filemtime("sitemap2.xml");
                $date2 = date("Y-m-d H:i:s",$b);

                $dom = new \DOMDocument('1.0', 'utf-8');
                $path = "sitemaps.xml";     //  $path 为xml文件的存储路径。
                $sitemapindex = $dom->createElement('sitemapindex'); // root node 
                $dom->appendChild($sitemapindex);       

                //引入sitemaps1.xml
                $sitemap = $dom->createElement('sitemap');
                $sitemapindex->appendChild($sitemap);

                $loc = $dom->createElement('loc');
                $loc_value = $dom->createTextNode('http://www.renrenlie.com/sitemap1.xml');
                $loc->appendChild($loc_value);
                $sitemap->appendChild($loc);

                $lastmod = $dom->createElement('lastmod');
                $lastmod_value = $dom->createTextNode($date1);
                $lastmod->appendChild($lastmod_value);
                $sitemap->appendChild($lastmod);

                //引入sitemaps2.xml
                $sitemap = $dom->createElement('sitemap');
                $sitemapindex->appendChild($sitemap);

                $loc = $dom->createElement('loc');
                $loc_value = $dom->createTextNode('http://www.renrenlie.com/sitemap2.xml');
                $loc->appendChild($loc_value);
                $sitemap->appendChild($loc);

                $lastmod = $dom->createElement('lastmod');
                $lastmod_value = $dom->createTextNode($date2);
                $lastmod->appendChild($lastmod_value);
                $sitemap->appendChild($lastmod);

//                echo $dom->saveXML();
                $re = $dom->save($path);
                echo "<br/>";
                var_dump($re);
        }

        /**
         * 生成sitemap1.xml页面  
         * 
         * @access public 
         * @since 1.0 
         */
        function create_sitemap1() {
                $date = date("Y-m-d");
                $dom = new \DOMDocument('1.0', 'utf-8');
                $path = "sitemap1.xml";     //  $path 为xml文件的存储路径。

                $urlset = $dom->createElement('urlset'); // root node 
                $xmlns = $dom->createAttribute('xmlns');
                $xmlns->nodeValue = "http://www.sitemaps.org/schemas/sitemap/0.9";
                $urlset->setAttributeNode($xmlns);
                $dom->appendChild($urlset);

                //网站地图的常见访问页面
                $arLinks = array(
                    "http://www.renrenlie.com",
                    "http://www.renrenlie.com/Home/Index/search.html",
                    "http://www.renrenlie.com/Home/Index/anli.html",
                    "http://www.renrenlie.com/Home/Active/salon_show.html",
                    "http://www.renrenlie.com/Home/Active/new_sign_up",
                    "http://www.renrenlie.com/Home/Public/aboutus.html",
                    "http://www.renrenlie.com/Home/Public/yhxy.html",
                    "http://www.renrenlie.com/Home/Public/yhys.html",
                    "http://www.renrenlie.com/Home/Public/contactus.html",
                    "http://www.renrenlie.com/Home/Public/joinus.html",
                    "http://www.renrenlie.com/Home/public/qa.html"
                );

                /*                 * ***************循环开始***************** */
                foreach ($arLinks as $v) {
                        $url = $dom->createElement('url');
                        $urlset->appendChild($url);

                        $loc = $dom->createElement('loc');
                        $loc_value = $dom->createTextNode($v);
                        $loc->appendChild($loc_value);
                        $url->appendChild($loc);

                        $lastmod = $dom->createElement('lastmod');
                        $lastmod_value = $dom->createTextNode($date);
                        $lastmod->appendChild($lastmod_value);
                        $url->appendChild($lastmod);

                        $changefreq = $dom->createElement('changefreq');
                        $changefreq_value = $dom->createTextNode('monthly');
                        $changefreq->appendChild($changefreq_value);
                        $url->appendChild($changefreq);

                        $priority = $dom->createElement('priority');
                        $priority_value = $dom->createTextNode('1');
                        $priority->appendChild($priority_value);
                        $url->appendChild($priority);
                }

                /*                 * ***************循环结束***************** */

//                echo $dom->saveXML();
                $re = $dom->save($path);
                echo "<br/>";
                var_dump($re);
        }

        /**
         * 生成sitemap2.xml页面  
         * 
         * @access public 
         * @since 1.0 
         */
        function create_sitemap2() {
                $date = date("Y-m-d");
                $dom = new \DOMDocument('1.0', 'utf-8');
                $path = "sitemap2.xml";     //  $path 为xml文件的存储路径。

                $urlset = $dom->createElement('urlset'); // root node 
                $xmlns = $dom->createAttribute('xmlns');
                $xmlns->nodeValue = "http://www.sitemaps.org/schemas/sitemap/0.9";
                $urlset->setAttributeNode($xmlns);
                $dom->appendChild($urlset);

                //最新职位列表
                $arJobList = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and  checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0")->order("orderid ASC,checktime DESC, starttime DESC")->select();

                /*                 * ***************循环开始***************** */
                foreach ($arJobList as $v) {
                        $url = $dom->createElement('url');
                        $urlset->appendChild($url);

                        $loc = $dom->createElement('loc');
                        $loc_value = $dom->createTextNode('http://www.renrenlie.com/Home/Index/EnterIndex2/comid/' . $v['cpid'] . '/jobid/' . $v['guid'] . '.html');
                        $loc->appendChild($loc_value);
                        $url->appendChild($loc);

                        $lastmod = $dom->createElement('lastmod');
                        $lastmod_value = $dom->createTextNode($date);
                        $lastmod->appendChild($lastmod_value);
                        $url->appendChild($lastmod);

                        $changefreq = $dom->createElement('changefreq');
                        $changefreq_value = $dom->createTextNode('dayly');
                        $changefreq->appendChild($changefreq_value);
                        $url->appendChild($changefreq);

                        $priority = $dom->createElement('priority');
                        $priority_value = $dom->createTextNode('1');
                        $priority->appendChild($priority_value);
                        $url->appendChild($priority);
                }
                /*                 * ***************循环结束***************** */

//                echo $dom->saveXML();
                $re = $dom->save($path);
                echo "<br/>";
                var_dump($re);
        }

}
