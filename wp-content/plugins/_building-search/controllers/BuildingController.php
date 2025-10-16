<?php
namespace Building\Controllers;

use Building\Models\BuildingModel;

class BuildingController extends Controller {

    private $model;

    public function __construct() {
        $this->model = new BuildingModel();
    }

    public function register_hooks() {
        $render = ( !empty($_GET) ) ? 'buildingsResult' : 'buildingsQuan';
        add_shortcode('buildings_search', [$this, $render]);
    }

    public function buildingsQuan() {
        $page           = $this->model->page();
        $taxonomy       = $page->slug; // dùng slug làm taxonomy
        $quans          = $this->model->quans($taxonomy);
        $hangs          = $this->model->hangs($taxonomy);
        $buildingsQuan  = $this->model->buildingsQuan($taxonomy, $quans);

        $filterQuanKey  = filterQuanKey($taxonomy); // helper camelCase

        $selectedQuans  = [];
        if (!empty($_GET[$filterQuanKey])) {
            $selectedQuans = array_map('sanitize_text_field', explode(',', $_GET[$filterQuanKey]));
        }

        $selectedHangs = [];
        if (!empty($_GET['filter_hang'])) {
            $selectedHangs = array_map('sanitize_text_field', explode(',', $_GET['filter_hang']));
        }

        return $this->render('building-quan', [
            'page'          => $page,
            'taxonomy'      => $taxonomy,
            'quans'         => $quans,
            'hangs'         => $hangs,
            'buildingsQuan' => $buildingsQuan,
            'filterQuanKey' => $filterQuanKey,
            'selectedQuans' => $selectedQuans,
            'selectedHangs' => $selectedHangs,
        ]);
    }

    public function buildingsResult() {
        $page      = $this->model->page();
        $taxonomy  = $page->slug; // dùng slug làm taxonomy
        $quans     = $this->model->quans($taxonomy);
        $hangs     = $this->model->hangs($taxonomy);
        $buildings = $this->model->buildings($taxonomy);

        $filterQuanKey = filterQuanKey($taxonomy); // helper camelCase

        $selectedQuans = [];
        if (!empty($_GET[$filterQuanKey])) {
            $selectedQuans = array_map('sanitize_text_field', explode(',', $_GET[$filterQuanKey]));
        }

        $selectedHangs = [];
        if (!empty($_GET['filter_hang'])) {
            $selectedHangs = array_map('sanitize_text_field', explode(',', $_GET['filter_hang']));
        }

        return $this->render('building-result', [
            'page'          => $page,
            'taxonomy'      => $taxonomy,
            'quans'         => $quans,
            'hangs'         => $hangs,
            'buildings'     => $buildings,
            'filterQuanKey' => $filterQuanKey,
            'selectedQuans' => $selectedQuans,
            'selectedHangs' => $selectedHangs,
        ]);
    }

}
