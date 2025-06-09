import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sisfo_sarpras/api/api_peminjaman.dart';

class TambahPeminjamanPage extends StatefulWidget {
  final int barangId;

  const TambahPeminjamanPage({super.key, required this.barangId});

  @override
  State<TambahPeminjamanPage> createState() => _TambahPeminjamanPageState();
}

class _TambahPeminjamanPageState extends State<TambahPeminjamanPage> {
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _tanggalPinjamController = TextEditingController();
  final TextEditingController _keteranganController = TextEditingController();

  bool isSubmitting = false;

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
    );

    setState(() => isSubmitting = false);

    if (result) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text("Peminjaman berhasil diajukan. Menunggu persetujuan admin.")),
      );
      Navigator.pop(context);
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text("Gagal mengajukan peminjaman")),
      );
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
          child: Column(
            children: [
              TextFormField(
                controller: _tanggalPinjamController,
                decoration: const InputDecoration(
                  labelText: "Tanggal Pinjam (YYYY-MM-DD)",
                ),
                validator: (value) =>
                    value == null || value.isEmpty ? "Tanggal pinjam wajib diisi" : null,
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
              )
            ],
          ),
        ),
      ),
    );
  }
}
