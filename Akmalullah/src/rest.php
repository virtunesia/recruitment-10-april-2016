<!--request.php-->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Request extends CI_Model {
	public function getCountRequest()
  {
      return $this->db->count_all_results('request', FALSE);
  }

  public function getMahasiswa($page, $size)
  {
      return $this->db->get('request', $size, $page);
  }

  public function insertRequest($dataRequest)
  {
      $val = array(
        'id' => $dataRequest['id'],
        'string' => $dataRequest['string'],
      );
      $this->db->insert('request', $val);
  }
public function updateRequest($dataRequest, $id)
  {
    $val = array(
      'string' => $dataRequest['string'],
);
    $this->db->where('id', $npm);
    $this->db->update('request', $val);
  }

  public function deleteRequest($npm)
  {
    $val = array(
      'id' => $id
    );
    $this->db->delete('request', $val);
  }

}
?>
<!-- Controler.php-->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RequestController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Request');
  }

  public function getRequest($page, $size)
  {

    $response = array(
      'content' => $this->Request->getRequest(($page - 1) * $size, $size)->result(),
      'totalPages' => ceil($this->Request->getCountRequest() / $size));

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function saveRequest()
  {
      $data = (array)json_decode(file_get_contents('php://input'));
      $this->Request->insertRequest($data);

      $response = array(
        'Success' => true,
        'Info' => 'Data Tersimpan');

      $this->output
        ->set_status_header(201)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        ->_display();
        exit;
  }

  public function updateRequest($id)
  {
    $data = (array)json_decode(file_get_contents('php://input'));
    $this->Request->updateRequest($data, $id);

    $response = array(
      'Success' => true,
      'Info' => 'Data Berhasil di update');

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function deleteRequest($id)
  {
    $this->Request->deleteRequest($id);

    $response = array(
      'Success' => true,
      'Info' => 'Data Berhasil di hapus');

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

}
