<?php
header("Content-Type: application/xml; charset=utf-8");
include_once 'includes/config.php';
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc><?php echo SITE_URL; ?>/</loc>
    <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc><?php echo SITE_URL; ?>/about</loc>
    <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc><?php echo SITE_URL; ?>/corporate</loc>
    <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc><?php echo SITE_URL; ?>/contact</loc>
    <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc><?php echo SITE_URL; ?>/privacy</loc>
    <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.3</priority>
  </url>
  <url>
    <loc><?php echo SITE_URL; ?>/terms</loc>
    <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.3</priority>
  </url>
</urlset>
