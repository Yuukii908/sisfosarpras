import 'dart:convert';
import 'package:flutter/material.dart';
import '../api/api_service.dart';

class CategoryPage extends StatelessWidget {
  const CategoryPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Kategori')),
      body: FutureBuilder(
        future: ApiService.getKategori('your_token_here'),
        builder: (context, snapshot) {
          if (!snapshot.hasData) return const Center(child: CircularProgressIndicator());
          final data = jsonDecode(snapshot.data!.body);
          final items = data['data'] as List;

          return ListView.builder(
            itemCount: items.length,
            itemBuilder: (_, i) => ListTile(
              title: Text(items[i]['nama']),
            ),
          );
        },
      ),
    );
  }
}
