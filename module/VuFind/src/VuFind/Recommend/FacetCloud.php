<?php
/**
 * FacetCloud Recommendations Module
 *
 * PHP Version 5
 *
 * Copyright (C) Villanova University 2011.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.    See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA    02111-1307    USA
 *
 * @category VuFind2
 * @package  Recommendations
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @author   Lutz Biedinger <lutz.biedinger@gmail.com>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://www.vufind.org  Main Page
 */
namespace VuFind\Recommend;

/**
 * FacetCloud Recommendations Module
 *
 * @category VuFind2
 * @package  Recommendations
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @author   Lutz Biedinger <lutz.biedinger@gmail.com>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://www.vufind.org  Main Page
 */
class FacetCloud extends ExpandFacets
{
    /**
     * Get the facet limit.
     *
     * @return int
     */
    public function getFacetLimit()
    {
        $params = $this->searchObject->getParams();
        $settings = is_callable(array($params, 'getFacetSettings'))
            ? $params->getFacetSettings() : array();

        // Figure out the facet limit -- if available, we can use this to display
        // "..." when more facets are available than are currently being displayed,
        // although this comes at the cost of not being able to display the last
        // entry in the list -- otherwise we might show "..." when we've exactly
        // reached (but not exceeded) the facet limit.  If we can't get a facet
        // limit, we will set an arbitrary high number so that all available values
        // will display and "..." will never display.
        return isset($settings['limit']) ? $settings['limit'] - 1 : 100000;
    }
}
