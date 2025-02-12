<?php

namespace App;


class ControllerBase
{
  public $layout = pathToRoot.'views/layouts/main.php';
  public $viewPath = pathToRoot.'views/';

  public function render($view, $params = []) {
    $view = $this->viewPath.$view.'.php';
    $content = $this->renderPhpFile($view, $params);
    echo $this->renderPhpFile($this->layout, ['content' => $content]); exit;
  }
  /**
   * Renders a view file as a PHP script.
   *
   * This method treats the view file as a PHP script and includes the file.
   * It extracts the given parameters and makes them available in the view file.
   * The method captures the output of the included view file and returns it as a string.
   *
   * This method should mainly be called by view renderer or [[renderFile()]].
   *
   * @param string $_file_ the view file.
   * @param array $_params_ the parameters (name-value pairs) that will be extracted and made available in the view file.
   * @return string the rendering result
   * @throws \Exception
   * @throws \Throwable
   */
  public function renderPhpFile($_file_, $_params_ = [])
  {
    $_obInitialLevel_ = ob_get_level();
    ob_start();
    ob_implicit_flush(false);
    extract($_params_, EXTR_OVERWRITE);
    try {
      require $_file_;
      return ob_get_clean();
    } catch (\Exception $e) {
      while (ob_get_level() > $_obInitialLevel_) {
        if (!@ob_end_clean()) {
          ob_clean();
        }
      }
      throw $e;
    } catch (\Throwable $e) {
      while (ob_get_level() > $_obInitialLevel_) {
        if (!@ob_end_clean()) {
          ob_clean();
        }
      }
      throw $e;
    }
  }

  public function outputResult($result = false, $data = ["error" => false])
  {
    http_response_code($result ? 200 : 400);
    echo json_encode($data);
    exit;
  }
}