class PeminjamanModel {
  final int id;
  final String peminjam;
  final String barang;
  final String kategori;
  final int jumlah;
  final String status;
  final String tanggalPinjam;

  PeminjamanModel({
    required this.id,
    required this.peminjam,
    required this.barang,
    required this.kategori,
    required this.jumlah,
    required this.status,
    required this.tanggalPinjam,
  });

  factory PeminjamanModel.fromJson(Map<String, dynamic> json) {
    return PeminjamanModel(
      id: json['id'],
      peminjam: json['peminjam'],
      barang: json['barang'],
      kategori: json['kategori'],
      jumlah: json['jumlah'],
      status: json['status'],
      tanggalPinjam: json['tanggal_pinjam'],
    );
  }
}
