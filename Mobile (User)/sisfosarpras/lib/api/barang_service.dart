import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/barang.dart';

class BarangService {
  static Future<List<BarangModel>> fetchBarang() async {
    final response = await http.get(Uri.parse('http://127.0.0.1:8000/api/barangApi'));

    if (response.statusCode == 200) {
      final Map<String, dynamic> decoded = json.decode(response.body);
      final List<dynamic> barangList = decoded['data'];
      return barangList.map((item) => BarangModel.fromJson(item)).toList();
    } else {
      throw Exception('Failed to load barang');
    }
  }
}
