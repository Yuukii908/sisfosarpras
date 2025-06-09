import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../api/api_pengembalian.dart';

class PengembalianPage extends StatefulWidget {
  const PengembalianPage({super.key});

  @override
  State<PengembalianPage> createState() => _PengembalianPageState();
}

class _PengembalianPageState extends State<PengembalianPage> {
  late Future<List<PengembalianModel>> _futureData;
  String? _token;

  @override
  void initState() {
    super.initState();
    _loadTokenAndFetch();
  }

  Future<void> _loadTokenAndFetch() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token');
    if (token != null) {
      setState(() {
        _token = token;
        _futureData = ApiPengembalian.fetchPengembalian(token);
      });
    }
  }

  Future<void> _ubahStatus(int id) async {
    if (_token == null) return;
    final success = await ApiPengembalian.ubahStatusPengembalian(id, _token!);
    if (success) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Status berhasil diubah')),
      );
      setState(() {
        _futureData = ApiPengembalian.fetchPengembalian(_token!);
      });
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Gagal mengubah status')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Data Pengembalian'),
        backgroundColor: Colors.blue[800],
      ),
      body: _token == null
          ? const Center(child: CircularProgressIndicator())
          : FutureBuilder<List<PengembalianModel>>(
              future: _futureData,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const Center(child: CircularProgressIndicator());
                } else if (snapshot.hasError) {
                  return Center(child: Text('Terjadi kesalahan: ${snapshot.error}'));
                } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                  return const Center(child: Text('Tidak ada data.'));
                }

                final pengembalianList = snapshot.data!;
                return ListView.builder(
                  itemCount: pengembalianList.length,
                  itemBuilder: (context, index) {
                    final item = pengembalianList[index];
                    return Card(
                      margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                      child: ListTile(
                        title: Text('Nama: ${item.namaPeminjam}'),
                        subtitle: Text('Barang: ${item.barang} | Status: ${item.status}'),
                        trailing: item.status != 'Barang sudah dikembalikan'
                            ? ElevatedButton(
                                onPressed: () => _ubahStatus(item.id),
                                child: const Text('Kembalikan'),
                              )
                            : const Text('Selesai'),
                      ),
                    );
                  },
                );
              },
            ),
    );
  }
}
