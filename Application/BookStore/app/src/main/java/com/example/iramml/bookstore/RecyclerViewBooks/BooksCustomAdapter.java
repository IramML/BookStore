package com.example.iramml.bookstore.RecyclerViewBooks;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.iramml.bookstore.Model.Book;
import com.example.iramml.bookstore.Model.BooksResponse;
import com.example.iramml.bookstore.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class BooksCustomAdapter extends RecyclerView.Adapter<BooksCustomAdapter.ViewHolder>{
    String URL_BASE="http://192.168.0.17/bookstore/";
    Context context;
    ArrayList<Book> items;
    ClickListener listener;
    ViewHolder viewHolder;

    public BooksCustomAdapter(Context context, ArrayList<Book> items, ClickListener listener ){
        this.context=context;
        this.items=items;
        this.listener=listener;
    }
    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View view= LayoutInflater.from(context).inflate(R.layout.books_template,viewGroup,false);
        viewHolder=new ViewHolder(view, listener);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder viewHolder, int i) {
        Picasso.get().load(URL_BASE+items.get(i).image).placeholder(R.drawable.placeholder).into(viewHolder.ivImage);
        viewHolder.tvTitle.setText(items.get(i).title);
        viewHolder.tvAuthor.setText(items.get(i).author);
        viewHolder.tvEditorial.setText("Editorial: "+items.get(i).editorial);
        viewHolder.tvPages.setText("pages: "+items.get(i).pages);
        viewHolder.tvCost.setText("$"+items.get(i).cost);
        viewHolder.tvIsPDF.setText("PDF: "+items.get(i).is_pdf);
    }
    @Override
    public int getItemCount() {
        return items.size();
    }

    class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        ImageView ivImage;
        TextView tvTitle, tvAuthor, tvEditorial, tvPages, tvCost, tvIsPDF;
        ClickListener listener;
        public ViewHolder(View itemView, ClickListener listener) {
            super(itemView);
            ivImage=itemView.findViewById(R.id.ivImage);
            tvTitle=itemView.findViewById(R.id.tvTitle);
            tvAuthor=itemView.findViewById(R.id.tvAuthor);
            tvEditorial=itemView.findViewById(R.id.tvEditorial);
            tvPages=itemView.findViewById(R.id.tvPages);
            tvCost=itemView.findViewById(R.id.tvCost);
            tvIsPDF=itemView.findViewById(R.id.tvIsPDF);
            this.listener=listener;
            itemView.setOnClickListener(this);
        }

        @Override
        public void onClick(View view) {
            this.listener.onClick(view, getAdapterPosition());
        }
    }
}