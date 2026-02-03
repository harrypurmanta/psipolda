function bulanIndo(x){
	let bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    let al = "";
    if(x==null || x=="" || x=="null") {
        al = "";
    } else {
        let tgl = x.split("-")[2];
        let bln = x.split("-")[1];
        let thn = x.split("-")[0];

        al = tgl + " " + bulan[Math.abs(bln)-1] + " " + thn;
    }
    return al;
}