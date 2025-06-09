import 'dart:js_interop';

import 'package:flutter/material.dart';
import 'package:sisfo_sarpras/api/api_dashboard.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../models/barang.dart';
import '../api/barang_service.dart';

class DashboardPage extends StatefulWidget {
  const DashboardPage({super.key});

  @override
  State<DashboardPage> createState() => _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage> {
  int _selectedIndex = 0;
  DashboardData? _dashboardData;
  bool _isLoading = true;
  String? _error;
  late Future<List<BarangModel>> _barangFuture;
  List<BarangModel> _allBarang = [];
  List<BarangModel> _filteredBarang = [];
  String _searchQuery = '';

  @override
  void initState() {
    super.initState();
    _fetchDashboard();
    _barangFuture = _fetchBarang();
  }

  Future<void> _fetchDashboard() async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final token = prefs.getString('token') ?? '';
      final data = await ApiDashboard.fetchDashboardData(token);
      setState(() {
        _dashboardData = data;
        _isLoading = false;
      });
    } catch (e) {
      setState(() {
        _error = 'Gagal memuat data: $e';
        _isLoading = false;
      });
    }
  }

  Future<List<BarangModel>> _fetchBarang() async {
    final items = await BarangService.fetchBarang();
    setState(() {
      _allBarang = items;
      _filteredBarang = items;
    });
    return items;
  }

  void _onSearchChanged(String query) {
    setState(() {
      _searchQuery = query.toLowerCase();
      _filteredBarang = _allBarang.where((barang) {
        return barang.nama.toLowerCase().contains(_searchQuery) ||
            barang.nama.toLowerCase().contains(_searchQuery);
      }).toList();
    });
  }

  void _onNavTap(int index) {
    if (_selectedIndex == index) return;
    setState(() => _selectedIndex = index);

    switch (index) {
      case 0:
        Navigator.pushNamed(context, '/dashboard');
        break;
      case 1:
        Navigator.pushNamed(context, '/peminjaman');
        break;
      case 2:
        Navigator.pushNamed(context, '/pengembalian');
        break;
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        title: const Text('Dashboard'),
        backgroundColor: Colors.blue[800],
        centerTitle: true,
        elevation: 0,
      ),
      body: SafeArea(
        child: ListView(
          padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 16),
          children: [
            Image.asset('assets/images/logo.png', height: 80),
            const SizedBox(height: 24),

            const Text(
              'Cari Barang:',
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.w600),
            ),
            const SizedBox(height: 8),
            TextField(
              decoration: InputDecoration(
                hintText: 'Nama barang atau kategori...',
                prefixIcon: const Icon(Icons.search),
                border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
                filled: true,
                fillColor: Colors.grey[200],
              ),
              onChanged: _onSearchChanged,
            ),
            const SizedBox(height: 24),

            const Text(
              'Daftar Barang :',
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 8),

            FutureBuilder<List<BarangModel>>(
              future: _barangFuture,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const Center(child: CircularProgressIndicator());
                } else if (snapshot.hasError) {
                  return Text('Gagal memuat barang: ${snapshot.error}');
                } else if (_filteredBarang.isEmpty) {
                  return const Text('Tidak ada barang yang cocok.');
                } else {
                  return GridView.builder(
                    shrinkWrap: true,
                    physics: const NeverScrollableScrollPhysics(),
                    gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                      crossAxisCount: 2,
                      mainAxisSpacing: 10,
                      crossAxisSpacing: 10,
                      childAspectRatio: 3 / 2,
                    ),
                    itemCount: _filteredBarang.length,
                    itemBuilder: (context, index) {
                      final barang = _filteredBarang[index];
                      return Card(
                        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                        elevation: 2,
                        child: Column(
                          children: [
                            Expanded(
                              child: barang.foto.tojs
                                  ? ClipRRect(
                                      borderRadius: const BorderRadius.vertical(top: Radius.circular(10)),
                                      child: Image.network(
                                        'http://http://127.0.0.1:8000/storage/${barang}',
                                        width: double.infinity,
                                        fit: BoxFit.cover,
                                      ),
                                    )
                                  : const Icon(Icons.image, size: 60),
                            ),
                            Padding(
                              padding: const EdgeInsets.all(6.0),
                              child: Column(
                                children: [
                                  Text(barang.nama,
                                      style: const TextStyle(fontWeight: FontWeight.bold), maxLines: 1, overflow: TextOverflow.ellipsis),
                                  Text('Stok: ${barang.stok}', style: const TextStyle(fontSize: 12)),
                                  Text(barang.nama, style: const TextStyle(fontSize: 12)),
                                ],
                              ),
                            ),
                          ],
                        ),
                      );
                    },
                  );
                }
              },
            ),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _selectedIndex,
        onTap: _onNavTap,
        selectedItemColor: Colors.blue[800],
        unselectedItemColor: Colors.grey,
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Beranda'),
          BottomNavigationBarItem(icon: Icon(Icons.assignment), label: 'Peminjaman'),
          BottomNavigationBarItem(icon: Icon(Icons.assignment_turned_in), label: 'Pengembalian'),
        ],
      ),
    );
  }

  Widget _buildStats(DashboardData data) {
    return Column(
      children: [
        _buildStatCard('Jumlah Barang', data.jumlahBarang, Icons.inventory),
        _buildStatCard('Barang Dipinjam', data.barangDipinjam, Icons.remove_shopping_cart),
        _buildStatCard('Barang Dikembalikan', data.barangDikembalikan, Icons.assignment_turned_in),
        _buildStatCard('User Online', data.userOnline, Icons.people_alt),
      ],
    );
  }

  Widget _buildStatCard(String title, int value, IconData icon) {
    return Card(
      margin: const EdgeInsets.symmetric(vertical: 8),
      elevation: 3,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      child: ListTile(
        leading: Icon(icon, color: Colors.blue[700]),
        title: Text(title),
        trailing: Text(
          value.toString(),
          style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 18),
        ),
      ),
    );
  }

  Widget _buildMenuButton(BuildContext context, IconData icon, String label, String route) {
    return SizedBox(
      width: double.infinity,
      height: 55,
      child: ElevatedButton.icon(
        style: ElevatedButton.styleFrom(
          backgroundColor: Colors.blue[700],
          foregroundColor: Colors.white,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
          ),
          textStyle: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
        ),
        icon: Icon(icon),
        label: Text(label),
        onPressed: () => Navigator.pushNamed(context, route),
      ),
    );
  }
}
