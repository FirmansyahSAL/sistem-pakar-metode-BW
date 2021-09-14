public function save_tiket()
{
$upload = $_FILES['image_user']['name'];
if ($upload) {
$config['upload_path'] = './assets/images/profile/';
$config['allowed_types'] = 'gif|jpg|png|jpeg';
$config['max_size'] = '2048';

$this->load->library('upload', $config);

if ($this->upload->do_upload('image_user')) {
$imageName = $this->upload->data('file_name');
$data = [
'image_user' => $imageName,
'username' => $imageName,
'created' => time()
];

$this->M_karyawan->upload($data);
} else {
$this->session->set_flashdata('message', $this->upload->display_errors());
redirect('karyawan/profile/' . $this->session->id_users);
}
} else {
$this->session->set_flashdata('message', 'tidak ada');
redirect('karyawan/profile/' . $this->session->id_users);
}
}