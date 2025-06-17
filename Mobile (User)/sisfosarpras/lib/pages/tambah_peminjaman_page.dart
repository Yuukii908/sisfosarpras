import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sisfo_sarpras/api/api_peminjaman.dart';
import 'package:intl/intl.dart';

class TambahPeminjamanPage extends StatefulWidget {
  final int barangId;

  const TambahPeminjamanPage({super.key, required this.barangId});

  @override
  State<TambahPeminjamanPage> createState() => _TambahPeminjamanPageState();
}

class _TambahPeminjamanPageState extends State<TambahPeminjamanPage> {
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _tanggalPinjamController =
      TextEditingController();
  final TextEditingController _keteranganController = TextEditingController();
  final TextEditingController _jumlahController = TextEditingController();

  bool isSubmitting = false;
  int _selectedIndex = 0;

  Future<void> _submitPeminjaman() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => isSubmitting = true);

    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token') ?? '';

    final result = await ApiPeminjaman.tambahPeminjaman(
      token: token,
      barangId: widget.barangId,
      tanggalPinjam: _tanggalPinjamController.text,
      keterangan: _keteranganController.text,
      jumlah: int.parse(_jumlahController.text),
    );

    setState(() => isSubmitting = false);

    if (result) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
            content: Text(
                "Peminjaman berhasil diajukan. Menunggu persetujuan admin.")),
      );
      Navigator.pop(context);
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text("Gagal mengajukan peminjaman")),
      );
    }
  }

  Future<void> _selectTanggalPinjam() async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2024),
      lastDate: DateTime(2100),
    );
    if (picked != null) {
      final formatted = DateFormat('yyyy-MM-dd').format(picked);
      setState(() {
        _tanggalPinjamController.text = formatted;
      });
    }
  }

  void _onItemTapped(int index) {
    setState(() => _selectedIndex = index);
    // Ganti ke halaman lain jika diperlukan
    if (index == 0) {
      Navigator.pushNamed(context, '/dashboard');
    } else if (index == 1) {
      Navigator.pushNamed(context, '/riwayat');
    } else if (index == 2) {
      Navigator.pushNamed(context, '/profil');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Ajukan Peminjaman"),
        backgroundColor: Colors.blue[800],
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [
              TextFormField(
                controller: _tanggalPinjamController,
                readOnly: true,
                decoration: const InputDecoration(
                  labelText: "Tanggal Pinjam",
                  suffixIcon: Icon(Icons.calendar_today),
                ),
                onTap: _selectTanggalPinjam,
                validator: (value) => value == null || value.isEmpty
                    ? "Tanggal pinjam wajib diisi"
                    : null,
              ),
              const SizedBox(height: 12),
              TextFormField(
                controller: _jumlahController,
                keyboardType: TextInputType.number,
                decoration: const InputDecoration(
                  labelText: "Jumlah Barang",
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return "Jumlah barang wajib diisi";
                  }
                  final intVal = int.tryParse(value);
                  if (intVal == null || intVal <= 0) {
                    return "Masukkan jumlah yang valid";
                  }
                  return null;
                },
              ),
              const SizedBox(height: 12),
              TextFormField(
                controller: _keteranganController,
                decoration: const InputDecoration(
                  labelText: "Keterangan",
                ),
                maxLines: 3,
              ),
              const SizedBox(height: 20),
              ElevatedButton(
                onPressed: isSubmitting ? null : _submitPeminjaman,
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.blue,
                ),
                child: isSubmitting
                    ? const CircularProgressIndicator(color: Colors.white)
                    : const Text("Ajukan Peminjaman"),
              ),
            ],
          ),
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _selectedIndex,
        onTap: _onItemTapped,
        selectedItemColor: Colors.blue[800],
        items: const [
          BottomNavigationBarItem(
            icon: Icon(Icons.dashboard),
            label: 'Dashboard',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.history),
            label: 'Peminjaman',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.person),
            label: 'Pengembalian',
          ),
        ],
      ),
    );
  }
}
