import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:sisfo_sarpras/models/peminjaman.dart';

class ApiPeminjaman {
  static const baseUrl = 'http://127.0.0.1:8000/api';

  // Tambah Peminjaman oleh User
  static Future<bool> tambahPeminjaman({
    required String token,
    required int barangId,
    required String tanggalPinjam,
    String? keterangan,
    required int jumlah,
  }) async {
    final response = await http.post(
      Uri.parse('$baseUrl/peminjaman'),
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
      body: {
        'barang_id': barangId.toString(),
        'tanggal_pinjam': tanggalPinjam,
        'keterangan': keterangan ?? '',
        'jumlah': jumlah.toString(),
        'status': 'Menunggu',
      },
    );

    return response.statusCode == 201 || response.statusCode == 200;
  }

  // Ambil Semua Peminjaman (Untuk User dan Admin)
  static Future<List<PeminjamanModel>> fetchPeminjaman(String token) async {
    final response = await http.get(
      Uri.parse('$baseUrl/peminjaman'),
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      final List<dynamic> data = jsonData['data'];
      return data.map((e) => PeminjamanModel.fromJson(e)).toList();
    } else {
      throw Exception('Gagal memuat data peminjaman');
    }
  }

  // Setujui Peminjaman (Fitur untuk Admin)
  static Future<bool> setujuiPeminjaman({
    required int id,
    required String token,
  }) async {
    final response = await http.put(
      Uri.parse('$baseUrl/peminjaman/$id/setujui'),
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
    );

    return response.statusCode == 200;
  }
}
