import 'dart:convert';
import 'package:http/http.dart' as http;

class PengembalianModel {
  final int id;
  final String namaPeminjam;
  final String barang;
  final String status;

  PengembalianModel({
    required this.id,
    required this.namaPeminjam,
    required this.barang,
    required this.status,
  });

  factory PengembalianModel.fromJson(Map<String, dynamic> json) {
    return PengembalianModel(
      id: json['id'],
      namaPeminjam: json['nama_peminjam'],
      barang: json['barang'],
      status: json['status'],
    );
  }
}

class ApiPengembalian {
  static const String baseUrl = 'http://127.0.0.1:8000/api';

  // Ambil semua data peminjaman yang belum dikembalikan
  static Future<List<PengembalianModel>> fetchPengembalian(String token) async {
    final response = await http.get(
      Uri.parse('$baseUrl/pengembalian'),
      headers: {'Authorization': 'Bearer $token'},
    );

    if (response.statusCode == 200) {
      final List<dynamic> data = jsonDecode(response.body)['data'];
      return data.map((e) => PengembalianModel.fromJson(e)).toList();
    } else {
      throw Exception('Gagal memuat data pengembalian');
    }
  }

  // Update status menjadi "Barang sudah dikembalikan"
  static Future<bool> ubahStatusPengembalian(int id, String token) async {
    final response = await http.put(
      Uri.parse('$baseUrl/pengembalian/$id'),
      headers: {
        'Authorization': 'Bearer $token',
        'Content-Type': 'application/json',
      },
      body: jsonEncode({'status': 'Barang sudah dikembalikan'}),
    );

    return response.statusCode == 200;
  }
}
