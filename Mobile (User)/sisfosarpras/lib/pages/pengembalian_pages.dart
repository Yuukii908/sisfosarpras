import 'dart:convert';
import 'package:flutter/material.dart';
import '../api/api_service.dart';

class PengembalianPage extends StatelessWidget {
  const PengembalianPage({super.key});

  final String token = 'your_token_here'; // Ganti dengan token dari login

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Data Pengembalian')),
      body: FutureBuilder(
        future: ApiService.getPengembalian(token),
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
                  subtitle: Text('Tanggal Kembali: ${item['tanggal_kembali']}'),
                ),
              );
            },
          );
        },
      ),
    );
  }
}
