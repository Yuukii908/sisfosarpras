import 'package:flutter/material.dart';

class PengembalianPage extends StatelessWidget {
  const PengembalianPage({super.key});

  final List<Map<String, dynamic>> pengembalianList = const [
    {
      'barang': 'Proyektor Epson',
      'peminjam': 'Andi',
      'tanggal_kembali': '2025-05-20',
      'terlambat': 0,
      'denda': 0,
    },
    {
      'barang': 'Kamera Canon',
      'peminjam': 'Rina',
      'tanggal_kembali': '2025-05-18',
      'terlambat': 2,
      'denda': 20000,
    },
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Pengembalian'),
        backgroundColor: Colors.blue[800],
      ),
      backgroundColor: Colors.white,
      body: ListView.separated(
        padding: const EdgeInsets.all(16),
        itemCount: pengembalianList.length,
        separatorBuilder: (_, __) => const Divider(),
        itemBuilder: (context, index) {
          final item = pengembalianList[index];
          final terlambat = item['terlambat'] as int;
          final denda = item['denda'] as int;
          return ListTile(
            leading: const Icon(Icons.assignment_return, color: Colors.blue),
            title: Text(item['barang'], style: const TextStyle(fontSize: 18)),
            subtitle: Text('Peminjam: ${item['peminjam']}'),
            trailing: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                Text('Tgl Kembali: ${item['tanggal_kembali']}'),
                Text(
                  terlambat > 0 ? 'Terlambat: $terlambat hari' : 'Tepat waktu',
                  style: TextStyle(
                    color: terlambat > 0 ? Colors.red : Colors.green,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                if (denda > 0)
                  Text(
                    'Denda: Rp $denda',
                    style: const TextStyle(color: Colors.red, fontWeight: FontWeight.bold),
                  ),
              ],
            ),
          );
        },
      ),
    );
  }
}
