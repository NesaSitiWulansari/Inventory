var daysofweek = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
var month = [
	"Januari",
	"Februari",
	"Maret",
	"April",
	"Mei",
	"Juni",
	"Juli",
	"Agustus",
	"September",
	"Oktober",
	"November",
	"Desember",
];

function clock() {
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	var day = h < 11 ? "AM" : "PM";
	var daytoday = today.getDay();
	var date = today.getDate();
	var mon = today.getMonth();
	var year = today.getFullYear();

	h = h < 10 ? "0" + h : h;
	m = m < 10 ? "0" + m : m;
	s = s < 10 ? "0" + s : s;

	document.getElementById("jam").innerHTML = h;
	document.getElementById("menit").innerHTML = m;
	document.getElementById("detik").innerHTML = s;
	document.getElementById("time").innerHTML = day;
	document.getElementById("" + daysofweek[daytoday] + "").style.color = "#fff";
	document.getElementById("tanggal").innerHTML = date;
	document.getElementById("bulan").innerHTML = month[mon];
	document.getElementById("tahun").innerHTML = year;
}
var inter = setInterval(clock, 400);
