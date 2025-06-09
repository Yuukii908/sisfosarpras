import 'dart:convert';
import 'package:http/http.dart' as http;

class DashboardData {
  final int jumlahBarang;
  final int barangDipinjam;
  final int barangDikembalikan;
  final int userOnline;

  DashboardData({
    required this.jumlahBarang,
    required this.barangDipinjam,
    required this.barangDikembalikan,
    required this.userOnline,
  });

  factory DashboardData.fromJson(Map<String, dynamic> json) {
    return DashboardData(
      jumlahBarang: json['jumlah_barang'],
      barangDipinjam: json['barang_dipinjam'],
      barangDikembalikan: json['barang_dikembalikan'],
      userOnline: json['user_online'],
    );
  }
}

class ApiDashboard {
  static const String baseUrl = 'http://127.0.0.1:8000/api/dashboard'; // Ganti sesuai IP server kamu

  static Future<DashboardData> fetchDashboardData(String token) async {
    final response = await http.get(
      Uri.parse('$baseUrl/dashboard'),
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      return DashboardData.fromJson(jsonData);
    } else {
      throw Exception('Gagal mengambil data dashboard');
    }
  }
}
