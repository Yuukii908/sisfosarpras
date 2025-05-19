import 'dart:convert';
import 'package:http/http.dart' as http;

const baseUrl = 'http://10.0.2.2:8000/api';

  class ApiService {
  static Future<http.Response> login(String email, String password) async {
    final url = Uri.parse('http://10.0.2.2:8000/api/login');
    final response = await http.post(
       url,
    headers: {'Accept': 'application/json'},
    body: {'email': email, 'password': password},
  ).timeout(const Duration(seconds: 10));
  return response;
}

  static Future<http.Response> register(String name, String email, String password) {
    return http.post(Uri.parse('$baseUrl/register'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode({'name': name, 'email': email, 'password': password}),
    );
  }

  static Future<http.Response> getKategori(String token) {
    return http.get(Uri.parse('$baseUrl/kategori'),
      headers: {'Authorization': 'Bearer $token'},
    );
  }

  static Future<http.Response> getPeminjaman(String token) {
    return http.get(Uri.parse('$baseUrl/peminjaman'),
      headers: {'Authorization': 'Bearer $token'},
    );
  }

  static Future<http.Response> getPengembalian(String token) {
    return http.get(Uri.parse('$baseUrl/pengembalian'),
      headers: {'Authorization': 'Bearer $token'},
    );
  }
}
