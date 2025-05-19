import 'dart:convert';
import 'package:flutter/material.dart';
import '../api/api_service.dart';

class PeminjamanPage extends StatelessWidget {
  const PeminjamanPage({super.key});

  final String token = 'your_token_here'; // Ganti dengan token yang valid

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Data Peminjaman')),
      body: FutureBuilder(
        future: ApiService.getPeminjaman(token),
        builder: (context, snapshot) {
          if (!snapshot.hasData) {
            return const Center(child: CircularProgressIndicator());
          }

          final response = snapshot.data!;
          if (response.statusCode != 200) {
            return Center(child: Text('Gagal mengambil data'));
          }

          final data = jsonDecode(response.body);
          final List items = data['data'];

          return ListView.builder(
            itemCount: items.length,
            itemBuilder: (context, index) {
              final item = items[index];
              return Card(
                child: ListTile(
                  title: Text('Nama: ${item['nama_peminjam']}'),
                  subtitle: Text('Tanggal: ${item['tanggal_pinjam']}'),
                ),
              );
            },
          );
        },
      ),
    );
  }
}
