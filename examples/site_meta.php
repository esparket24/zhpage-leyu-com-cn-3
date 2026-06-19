<?php

/**
 * Site metadata helper for zhpage-leyu.com.cn
 * 
 * Provides structured site metadata and a descriptive text generator.
 */

class SiteMeta
{
    private string $siteName;
    private string $domain;
    private string $description;
    private array $keywords;
    private string $language;
    private string $charset;
    private array $socialLinks;

    public function __construct()
    {
        $this->siteName = '乐鱼体育';
        $this->domain = 'https://zhpage-leyu.com.cn';
        $this->description = '专业的体育资讯与赛事分析平台，提供最新体育动态。';
        $this->keywords = ['乐鱼体育', '体育资讯', '赛事分析', '运动动态'];
        $this->language = 'zh-CN';
        $this->charset = 'UTF-8';

        $this->socialLinks = [
            'weibo' => 'https://weibo.com/leiyusports',
            'wechat' => 'https://mp.weixin.qq.com/leiyusports',
            'douyin' => 'https://www.douyin.com/leiyusports'
        ];
    }

    /**
     * Get the full site name with optional suffix.
     *
     * @param string $suffix
     * @return string
     */
    public function getSiteName(string $suffix = ''): string
    {
        $name = $this->siteName;
        if (!empty($suffix)) {
            $name .= ' - ' . $suffix;
        }
        return $name;
    }

    /**
     * Get the base domain URL.
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Get the site description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get all keywords associated with the site.
     *
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * Get the language code.
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Get the character encoding.
     *
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     * Get social media links.
     *
     * @return array
     */
    public function getSocialLinks(): array
    {
        return $this->socialLinks;
    }

    /**
     * Generate a short descriptive text for the site,
     * suitable for meta tags or summary blocks.
     *
     * @param int $maxLength Maximum length of the generated text (optional)
     * @return string
     */
    public function generateDescriptionText(int $maxLength = 0): string
    {
        $parts = [
            $this->siteName,
            '：',
            $this->description,
            ' 关注我们：',
            $this->domain,
            ' 关键词：',
            implode('、', array_slice($this->keywords, 0, 3))
        ];

        $text = implode('', $parts);

        if ($maxLength > 0 && mb_strlen($text) > $maxLength) {
            $text = mb_substr($text, 0, $maxLength - 3) . '...';
        }

        return $text;
    }

    /**
     * Generate an HTML meta description tag.
     *
     * @return string
     */
    public function generateMetaDescriptionTag(): string
    {
        $desc = htmlspecialchars($this->generateDescriptionText(160), ENT_QUOTES, $this->charset);
        return sprintf('<meta name="description" content="%s">', $desc);
    }

    /**
     * Generate an HTML meta keywords tag.
     *
     * @return string
     */
    public function generateMetaKeywordsTag(): string
    {
        $kw = htmlspecialchars(implode(', ', $this->keywords), ENT_QUOTES, $this->charset);
        return sprintf('<meta name="keywords" content="%s">', $kw);
    }

    /**
     * Return all core metadata as an associative array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'site_name' => $this->siteName,
            'domain' => $this->domain,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'language' => $this->language,
            'charset' => $this->charset,
            'social_links' => $this->socialLinks,
        ];
    }
}

// Example usage (uncomment to test)
// $meta = new SiteMeta();
// echo $meta->generateDescriptionText() . PHP_EOL;
// echo $meta->generateMetaDescriptionTag() . PHP_EOL;
// echo $meta->generateMetaKeywordsTag() . PHP_EOL;