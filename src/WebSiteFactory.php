<?php
declare(strict_types=1);
namespace Plinct\Web;

use Plinct\Web\Fragment\Fragment;
use Plinct\Web\WebSite\WebSite;
use Plinct\Web\WebSite\WebSiteInterface;

class WebSiteFactory
{
  /**
   * @return WebSiteInterface
   */
  public static function create(): WebSiteInterface
  {
    return new WebSite();
  }

  public static function fragment(): Fragment
  {
    return new Fragment();
  }
}
