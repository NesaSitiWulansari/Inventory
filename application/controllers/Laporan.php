<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Clegginabox\PDFMerger\PDFMerger;


class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Menu');
		$this->load->model('M_Transaksi');
		$this->load->model('M_Barang');
		$this->load->model('M_Suplier');
		$this->load->model('M_Peminjaman');
		$this->load->library('dompdf_gen');
		is_logged_in();
	}

	public function barkel()
	{
		$data = [
			'title' => 'Laporan Barang Keluar',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];

		$data['barang'] = $this->M_Barang->getbarang();
		$data['barkel'] = $this->M_Barang->getbarkel()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

		$this->load->view('Template/Tampilan_Header', $data);
		$this->load->view('Laporan/laporanbarkel_view', $data);
		$this->load->view('Template/Tampilan_Footer');
	}

	public function pdfbarkel()
	{

		$data = [
			'title' => 'Laporan Barang Keluar',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];

		$data['barang'] = $this->M_Barang->getbarang();
		$data['barkel'] = $this->M_Barang->getbarkel()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

		$this->load->view('Laporan/pdf/laporanbarkel', $data);

		$paper_size = 'F4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_barangkeluar.pdf", array('Attachment' => 0));
	}

	public function pinjam()
	{
		$data = [
			'title' => 'Laporan Peminjaman',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];

		$data['pinjam'] = $this->M_Peminjaman->getpeminjaman1();

		$this->load->view('Template/Tampilan_Header', $data);
		$this->load->view('Laporan/laporanpinjam_view', $data);
		$this->load->view('Template/Tampilan_Footer');
	}

	public function pdfpinjam()
	{

		$data = [
			'title' => 'Laporan Barang Keluar',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];

		$id = $this->uri->segment(3);
		$data['pinjam'] = $this->M_Peminjaman->getpinjam($id);
		$data['detailpinjam'] = $this->M_Peminjaman->getdetail($id);

		$this->load->view('Laporan/pdf/laporanpinjam', $data);

		$paper_size = 'F4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_pinjam.pdf", array('Attachment' => 0));
	}

	public function beli()
	{
		$data = [
			'title' => 'Laporan Pembelian',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];

		$data['beli'] = $this->M_Suplier->getbeli1();

		$data['suplier'] = $this->M_Suplier->getsuplier();

		$this->load->view('Template/Tampilan_Header', $data);
		$this->load->view('Laporan/laporanbeli_view', $data);
		$this->load->view('Template/Tampilan_Footer');
	}


	public function pdfbeli()
	{
		$data = [
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];

		$id = $this->uri->segment(3);
		$data['beli'] = $this->M_Suplier->getbeli($id);
		
		$data['detailbeli'] = $this->M_Suplier->getdetail($id);

		$this->load->view('Laporan/pdf/laporanpembelian', $data);

		$paper_size = 'F4';
		$orientation = 'potrait';
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_pembelian.pdf", array('Attachment' => 0));
	}

	public function jual()
	{
		$data = [
			'title' => 'Laporan Penjualan',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];

		$data['jual'] = $this->M_Transaksi->getjual1();

		$this->load->view('Template/Tampilan_Header', $data);
		$this->load->view('Laporan/laporanjual_view', $data);
		$this->load->view('Template/Tampilan_Footer');
	}

	public function pdf()
	{
		$data = [
			'title' => 'Laporan Penjualan',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];
		$id = $this->uri->segment(3);
		$data['jual'] = $this->M_Transaksi->getjual($id);
		$data['detailjual'] = $this->M_Transaksi->getdetail($id);

		$this->load->view('Laporan/pdf/laporan_pdf', $data);

		$paper_size = 'F4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));
	}

	public function databarang()
	{
		$data = [
			'title' => 'Laporan Data Barang',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];

		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

		$this->load->view('Template/Tampilan_Header', $data);
		$this->load->view('Laporan/laporandatabarang', $data);
		$this->load->view('Template/Tampilan_Footer');
	}

	public function barangpdf()
	{
		$data = [
			'title' => 'Laporan Penjualan',
			'login' => $this->db->get_where('login', ['email' =>
			$this->session->userdata('email')])->row_array()
		];
		$data['barang'] = $this->M_Barang->getbarang1()->result_array();

		$this->load->view('Laporan/pdf/laporan_databarang', $data);

		$paper_size = 'F4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));
	}
}
