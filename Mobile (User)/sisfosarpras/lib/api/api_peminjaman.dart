import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiPeminjaman {
  static Future<bool> tambahPeminjaman({
    required String token,
    required int barangId,
    required String tanggalPinjam,
    String? keterangan,
  }) async {
    final response = await http.post(
      Uri.parse('http://127.0.0.1:8000/api/peminjaman'),
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
      body: {
        'barang_id': barangId.toString(),
        'tanggal_pinjam': tanggalPinjam,
        'keterangan': keterangan ?? '',
        'status': 'Menunggu', // penting!
      },
    );

    return response.statusCode == 201 || response.statusCode == 200;
  }
}
