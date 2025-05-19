import 'package:flutter/material.dart';

class DashboardPage extends StatelessWidget {
  const DashboardPage({super.key});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Dashboard')),
      body: Padding(
        padding: const EdgeInsets.all(20),
        child: Column(children: [
          ElevatedButton(
            onPressed: () => Navigator.pushNamed(context, '/kategori'),
            child: const Text('Lihat Kategori'),
          ),
          ElevatedButton(
            onPressed: () => Navigator.pushNamed(context, '/peminjaman'),
            child: const Text('Lihat Peminjaman'),
          ),
          ElevatedButton(
            onPressed: () => Navigator.pushNamed(context, '/pengembalian'),
            child: const Text('Lihat Pengembalian'),
          ),
        ]),
      ),
    );
  }
}
