<?php namespace App\Http\Controllers;

/**
 * @defgroup Epub
 */

use App\Models\EpubModel;
use App\Models\TransformModel;

/**
 * @file application/controllers/EpubController.php
 * Distributed under the GNU GPL v2. For
 * @class EpubController
 * @ingroup Epub
 * @brief Class defining operations for EPUB conversion from Microsoft Word Files
 */

class EpubController extends Controller
{

    /**
     * Constructor
     * Instantiate bootstrap, get instance of conversion tools
     */
    public function __construct(EpubModel $model, TransformModel $transform)
    {
        $this->epubModel = $model;
        $this->transform = $transform;
    }

    /**
     * createEpubAction
     * Set options, pass to instance of EpubModel()
     */
    public function create(array $customOptions = null) {
        $options = array(
            'options' => array (
                'Title' => 'Conversion Demonstration',
                'Language' => 'en',
                'Publisher' => 'FUBAR Publications',
                'Identifier' => '111-999-222'
            ),
            'src' => public_path().'/example/Ellinger-Xerxis.docx'
        );
        if ($customOptions) {
            $options['customOptions'] = $customOptions;
        }
        $this->epubModel->createEpub($this->transform, $options);
    }
}
