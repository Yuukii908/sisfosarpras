import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:sisfo_sarpras/models/peminjaman.dart';

class ApiPeminjaman {
  static const baseUrl = 'http://127.0.0.1:8000/api';

  static Future<List<PeminjamanModel>> fetchPeminjaman(String token) async {
    final response = await http.get(
      Uri.parse('$baseUrl/peminjaman'),
      headers: {'Authorization': 'Bearer $token'},
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body)['data'];
      return List<PeminjamanModel>.from(
        data.map((item) => PeminjamanModel.fromJson(item)),
      );
    } else {
      throw Exception('Gagal memuat data peminjaman');
    }
  }

  static Future<bool> tambahPeminjaman({
    required int barangId,
    required String tanggalPinjam,
    required String tanggalKembali,
    required String token,
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
        'tanggal_kembali': tanggalKembali,
      },
    );

    return response.statusCode == 201;
  }

  static Future<bool> ubahStatusPeminjaman(int id, String token) async {
    final response = await http.put(
      Uri.parse('$baseUrl/peminjaman/$id/ubah-status'),
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
    );
    return response.statusCode == 200;
  }
}
